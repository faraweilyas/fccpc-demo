<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicantController extends Controller
{
	/**
	 * Handles the home page route.
	 * @return void
	 */
    public function index()
    { 
    	$title            = APP_NAME;
        $description      = "FCCPC dashboard";
    	$details          = details($title, $description);
    	return view('backend.applicant.auth', compact('details'));
    }

    /**
     * Handles the submit application page route.
     * @return void
     */
    public function submitApplication()
    { 
        $title            = APP_NAME;
        $description      = "FCCPC Application";
        $details          = details($title, $description);
        return view('backend.applicant.submit', compact('details'));
    }
}