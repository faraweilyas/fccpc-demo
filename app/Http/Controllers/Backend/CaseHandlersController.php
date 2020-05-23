<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseHandlersController extends Controller
{
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
 }