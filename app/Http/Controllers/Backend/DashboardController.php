<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}