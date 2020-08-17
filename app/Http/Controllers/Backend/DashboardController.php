<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Models\User;
use App\Models\Cases;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        $cases            = new Cases();
    	$title            = APP_NAME;
        $description      = "FCCPC Dashboard";
    	$details          = details($title, $description);
    	return view('backend.admin.index', compact('details', 'cases'));
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
        return view('backend.admin.create-user', compact('details'));
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

        User::create([
            'firstName'     => trim(ucfirst($request->firstName)),
            'lastName'      => trim(ucfirst($request->lastName)),
            'email'         => $request->email,
            'password'      => Hash::make(config('app.default_password')),
            'accountType'   => $request->accountType,
        ]);

        return redirect()->back()->with("success", "User created sucessfully");
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
        return view('backend.admin.view-users', compact('details'));
    }

    /**
     * Handles the view profile page route.
     * @return void
     */
    public function viewProfile()
    {
        $user             = Auth::user();
        $title            = APP_NAME;
        $description      = "FCCPC Dashboard View Profile";
        $details          = details($title, $description);
        return view('backend.user.profile', compact('details', 'user'));
    }

    public function updateUserStatus($id)
    {
        $check_status = User::findOrFail($id);

        User::whereId($id)->update([
            'status' => !$check_status->status
        ]);

        return redirect()->back()->with("success", "User's status updated");
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'firstName'    => 'required',
            'lastName'     => 'required'
        ]);

        if (isset($request->password) && $request->change_pass == 'yes') {
            if (Hash::check($request->password, Auth::user()->password)) {
                if ($request->new_password === $request->password_confirmation) {
                    User::whereId(Auth::user()->id)->update([
                            'first_name' => $request->firstName,
                            'last_name'  => $request->lastName,
                            'password'  => Hash::make($request->new_password)
                     ]);

                    return redirect()->back()->with("success", "Profile updated");
                } else {
                    return redirect()->back()->with("error", "Password Mismatch");
                }
            } else {
                return redirect()->back()->with("error", "Invalid Password");
            }
        }

        User::whereId(Auth::user()->id)->update([
                'first_name' => $request->firstName,
                'last_name'  => $request->lastName
         ]);

        return redirect()->back()->with("success", "Profile updated");
    }
}
