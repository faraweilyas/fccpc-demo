<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CasesController extends Controller
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
	 * Handles the cases display page route.
	 * @return void
	 */
    public function index($type)
    { 
        $case             = formatCaseType($type);
    	$title            = APP_NAME;
        $description      = "FCCPC Cases Log Dashboard";
    	$details          = details($title, $description);
    	return view('backend.'.getAccountType().'.cases', compact('details', 'case', 'type'));
    }

    /**
     * Handles the case review page route.
     * @return void
     */
    public function reviewCase($id)
    { 
        $title            = APP_NAME;
        $description      = "FCCPC Case Review Dashboard";
        $details          = details($title, $description);
        return view('backend.'.getAccountType().'.review-case', compact('details', 'id'));
    }
}