<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cases;
use App\Models\Guest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    protected $methods          = [
        'saveCaseInfo'          => 'saveCaseInfo',
        'saveContactInfo'       => 'saveContactInfo',
        'saveCompanyDocuments'  => 'saveDocument',
        'saveAccountDocuments'  => 'saveDocument',
        'savePaymentDocuments'  => 'saveDocument',
    ];

	/**
     * Handles select application page.
     *
     * @param Guest $guest
     * @return \Illuminate\Contracts\View\Factory
     */
    public function index(Guest $guest)
    {
        if ($guest->case->isSubmitted())
            return redirect($guest->submittedApplicationPath());

        $title            = 'Select Application | '.APP_NAME;
        $description      = 'Select Application | '.APP_NAME;
        $details          = details($title, $description);
        return view('backend.applicant.select-application', compact('details', 'guest'));
    }

    /**
     * Handles create application page.
     *
     * @param Guest $guest
     * @param string $case_category_key
     * @return \Illuminate\Contracts\View\Factory
     */
    public function show(Guest $guest, string $case_category_key)
    {
        // Validate case category
        $result = !\AppHelper::validateKey('case_categories', strtoupper($case_category_key));
        abort_if($result, 404);

        $case = $guest->case;

        // Check if case has been submitted
        if ($case->isSubmitted())
            return redirect($guest->submittedApplicationPath());

        // Save selected case category
        $case->saveCategory($case_category_key);

        $case_category  = $case->getCaseCategory();
        $case_parties   = $case->getCaseParties(false);
        $title          = "{$case_category} Application | ".APP_NAME;
        $description    = "{$case_category} Application | ".APP_NAME;
        $details        = details($title, $description);
        return view('backend.applicant.create-application', compact('details', 'guest', 'case', 'case_category', 'case_parties'));
    }

    /**
     * Send response.
     *
     * @param string $message
     * @param string $responseType
     * @param mixed $response
     * @return void
     */
    public function sendResponse(string $message, string $responseType, $response=null)
    {
        echo json_encode([
            'message'       => $message,
            'responseType'  => $responseType,
            'response'      => $response,
        ]);
        exit;
    }

    /**
     * Proxy to create new case.
     *
     * @param Guest $guest
     * @param string $action
     * @return void
     */
    public function create(Guest $guest, string $action)
    {
        if (!in_array($action, array_keys($this->methods)))
            $this->sendResponse("Something went wrong, please try again", "error");

        $method = $this->methods[$action];
        call_user_func([$this, $method], $guest);

        return;
    }

    public function saveCaseInfo(Guest $guest)
    {
        $parties = is_array(request('parties')) ? request('parties') : [];

        $guest->case->saveCaseInfo(
            request('subject'),
            implode(':', $parties),
            request('case_type'),
        );

        $this->sendResponse("Case info saved.", "success", $guest->case);
    }

    public function saveContactInfo(Guest $guest)
    {
        $guest->case->saveContactInfo((object) [
            'applicant_firm'            => request('applicant_firm'),
            'applicant_first_name'      => request('applicant_first_name'),
            'applicant_last_name'       => request('applicant_last_name'),
            'applicant_email'           => request('applicant_email'),
            'applicant_phone_number'    => request('applicant_phone_number'),
            'applicant_address'         => request('applicant_address'),
        ]);

        $this->sendResponse("Contact info saved.", "success", $guest->case);
    }

    public function saveDocument(Guest $guest)
    {
        // $company_doc    = !empty($_FILES['company_doc']['name']) ? $_FILES['company_doc'] : [];
        // $newFileName    = substr(uniqid(), 5, 13).".$id";
    }

    /**
     * Upload New Case.
     *
     * @param string $id
     * @return void
     */
    public function uploadNewCase(Request $request, $id)
    {
        Cases::where('tracking_id', '=', $id)->update([
            'ref_no' => generateRefNo($id),
            'status' => 1
        ]);

        $case = Cases::where('tracking_id', '=', $id)->first();
        Mail::to($case->applicant_email)->send(new ApplicationRequest([
            'firstName'       => $case->applicant_first_name,
            'lastName'        => $case->applicant_last_name,
            'ref_no'          => $case->ref_no
        ]));
        $this->sendResponse(200, "OK!", "success", $case);
    }

    /**
     * Handles application submitted page route.
     *
     * @param Guest $guest
     * @return \Illuminate\Contracts\View\Factory
     */
    public function applicationSubmitted(Guest $guest)
    {
        $title          = 'Application Submitted | '.APP_NAME;
        $description    = 'Application Submitted | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.applicant.submitted', compact('details', 'guest'));
    }

    /**
     * Handles upload documents page
     *
     * @param Guest $guest
     * @return \Illuminate\Contracts\View\Factory
     */
    public function uploadDocuments(Guest $guest)
    {
        if (!$guest->case->isSubmitted())
            return redirect($guest->submittedApplicationPath());

        $title          = 'Upload Documents | '.APP_NAME;
        $description    = 'Upload Documents | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.applicant.upload-documents', compact('details', 'guest'));
    }
}
