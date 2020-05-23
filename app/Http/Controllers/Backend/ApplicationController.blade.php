<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
	/**
     * Handles the select application page route.
     * @param int $id
     * @return void
     */
    public function index($id)
    { 
        $title            = APP_NAME;
        $description      = "FCCPC Select Application Dashboard";
        $details          = details($title, $description);
        return view('backend.applicant.select-application', compact('details', 'id'));
    }

    /**
     * Handles the create application page route.
     * @param string $type
     * @param int $id
     * @return void
     */
    public function createApplication($type, $id)
    { 
        $title            = APP_NAME;
        $description      = "FCCPC Select Application Dashboard";
        $details          = details($title, $description);
        return view('backend.applicant.create-application', compact('details', 'id'));
    }
}