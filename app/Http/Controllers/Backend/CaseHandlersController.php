<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Auth;

class CaseHandlersController extends Controller
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
     * Handles the Case handlers display page route.
     * @param int $id
     * @return void
     */
    public function index()
    { 
        $title            = APP_NAME;
        $description      = "FCCPC Case Handlers Dashboard";
        $details          = details($title, $description);
        return view('backend.'.getAccountType().'.case-handlers', compact('details'));
    }

	/**
	 * Handles the create case handlers page route.
	 * @return void
	 */
    public function create()
    { 
    	$title            = APP_NAME;
        $description      = "FCCPC Create Handler Dashboard";
    	$details          = details($title, $description);
    	return view('backend.'.getAccountType().'.create-handler', compact('details'));
    }

    /**
     * Handles the store handler page route.
     * @return void
     */
    public function storeHandler(Request $request)
    { 
        $this->validate($request, [
            'firstName'       => ['required', 'string', 'max:255'],
            'lastName'        => ['required', 'string', 'max:255'],
            'email'           => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = \App\User::create([
            'firstName'     => trim(ucfirst($request->firstName)),
            'lastName'      => trim(ucfirst($request->lastName)),
            'email'         => $request->email,
            'password'      => Hash::make(trim(ucfirst($request->firstName)).'123'),
            'accountType'   => "CH",
        ]);

        if ($user) {
            Session::flash('success', "Case handler created sucessfully");
            return redirect()->back();
        } else {
            Session::flash('error', "Case handler not created sucessfully.");
            return redirect()->back();
        }
    }

    /**
     * Handles the view case handlers page route.
     * @return void
     */
    public function show()
    { 
        $title            = APP_NAME;
        $description      = "FCCPC Case Handler Dashboard";
        $details          = details($title, $description);
        return view('backend.'.getAccountType().'.view-case-handler', compact('details'));
    }
 }