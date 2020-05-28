<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Cases;

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
     * Handles the application success page route.
     * @param int $id
     * @return void
     */
    public function applicationSuccess($id)
    { 
        $title            = APP_NAME;
        $description      = "FCCPC Select Application Dashboard";
        $details          = details($title, $description);
        return view('backend.applicant.application-success', compact('details', 'id'));
    }

    /**
     * Handles the create application page route.
     * @param string $type
     * @param int $id
     * @return void
     */
    public function create($type, $id)
    { 
        $case             = formatApplicationType($type);
        $case_info        = Cases::where('tracking_id', '=', $id)->first();
        
        if ($case_info):
            if ($case_info->status > 0):
                return redirect()->route('application.success', ['id' => $id]);
            endif;

            $case_party_arr = explode(',', $case_info->parties);
        else:
            $case_party_arr = '';
        endif;

        $title            = APP_NAME;
        $description      = "FCCPC ".$case." Application Dashboard";
        $details          = details($title, $description);
        return view('backend.applicant.create-application', compact('details', 'id', 'type', 'case', 'case_info', 'case_party_arr'));
    }

    /**
     * Handles the upload supporting documents application page route.
     * @param int $id
     * @return void
     */
    public function supportingDocuments($id)
    { 
        $case             = Cases::where('tracking_id', '=', $id)->first();

        if ($case->status <= 0):
            Session::flash('error', "Please complete your application!");
            return redirect()->route('application.create', ['type' => strtolower(\App\Enhancers\AppHelper::$case_categories[$case->transaction_category]), 'id' => $id]);
        endif;

        $title            = APP_NAME;
        $description      = "FCCPC Upload Support Documents";
        $details          = details($title, $description);
        return view('backend.applicant.uploading-documents', compact('details', 'id'));
    }
}