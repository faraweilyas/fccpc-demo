<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	/**
	 * Handles the admin home page route.
	 * @return void
	 */
    public function index()
    { 
    	$title            = APP_NAME;
        $description      = "FCCPC dashboard";
    	$details          = details($title, $description);
    	return view('backend.'.getAccountType().'.index', compact('details'));
    }
}