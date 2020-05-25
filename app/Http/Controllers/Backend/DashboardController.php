<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Handles the admin home page route.
	 * @return void
	 */
    public function index()
    { 
    	$title            = APP_NAME;
        $description      = "FCCPC Dashboard";
    	$details          = details($title, $description);
    	return view('backend.'.getAccountType().'.index', compact('details'));
    }

    /**
     * Handles the create user page route.
     * @return void
     */
    public function createUser()
    { 
        $title            = APP_NAME;
        $description      = "FCCPC Dashboard Create User";
        $details          = details($title, $description);
        return view('backend.'.getAccountType().'.create-user', compact('details'));
    }

    /**
     * Handles the store user page route.
     * @return void
     */
    public function storeUser(Request $request)
    { 
        $this->validate($request, [
            'firstName'       => ['required', 'string', 'max:255'],
            'lastName'        => ['required', 'string', 'max:255'],
            'email'           => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'accountType'     => 'required',
        ]);

        $user = \App\User::create([
            'firstName'     => trim(ucfirst($request->firstName)),
            'lastName'      => trim(ucfirst($request->lastName)),
            'email'         => $request->email,
            'password'      => Hash::make($request->firstName.'123'),
            'accountType'   => $request->accountType,
        ]);

        if ($user) {
            Session::flash('success', "User created sucessfully");
            return redirect()->back();
        } else {
            Session::flash('error', "User not created sucessfully.");
            return redirect()->back();
        }
    }

    /**
     * Handles the view users page route.
     * @return void
     */
    public function viewUsers()
    { 
        $title            = APP_NAME;
        $description      = "FCCPC Dashboard View Users";
        $details          = details($title, $description);
        return view('backend.'.getAccountType().'.view-users', compact('details'));
    }

    public function updateUserStatus($id)
    {
        $check_status = \App\User::findOrFail($id);

        $result = \App\User::whereId($id)->update([
                'status' => !$check_status->status
         ]);

        if ($result) {
            Session::flash('success', "User's status updated");
            return redirect()->back();
        } else {
            Session::flash('error', "User's status not updated.");
            return redirect()->back();
        }
    }
}