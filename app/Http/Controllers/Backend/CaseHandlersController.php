<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CaseHandlersController extends Controller
{
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