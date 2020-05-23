<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CasesController extends Controller
{
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
}