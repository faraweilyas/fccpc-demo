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
    public function index($id)
    { 
    	$title            = APP_NAME;
        $description      = "FCCPC dashboard";
    	$details          = details($title, $description);
    	return view('backend.applicant.index', compact('details','id'));
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

    /**
     * Handles the select application page route.
     * @return void
     */
    public function selectApplication($id)
    { 
        $title            = APP_NAME;
        $description      = "FCCPC Select Application Dashboard";
        $details          = details($title, $description);
        return view('backend.applicant.select-application', compact('details', 'id'));
    }
}