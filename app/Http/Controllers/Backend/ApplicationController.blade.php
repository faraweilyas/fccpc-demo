<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * Handles the create application page route.
     * @param string $type
     * @param int $id
     * @return void
     */
    public function create($type, $id)
    { 
        $case             = formatApplicationType($type);
        $case_info        = Cases::where('tracking_id', '=', $id)->first();

        if (is_array($case_info)):
            if ($case_info->status == 1):
                return redirect()->route('applicant.index', ['id' => $guest->tracking_id]);
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
}