<?php

namespace App\Http\Controllers\Backend;

use App\Models\Guest;
use App\Models\Document;
use App\Mail\ApplicationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    protected $methods = [
        'saveCaseInfo' => 'saveCaseInfo',
        'saveContactInfo' => 'saveContactInfo',
        'saveChecklistDocument' => 'saveChecklistDocument',
    ];

    /**
     * Handles select application page.
     *
     * @param Guest $guest
     * @return \Illuminate\Contracts\View\Factory
     */
    public function index(Guest $guest)
    {
        if ($guest->case->isSubmitted()) {
            return redirect($guest->submittedApplicationPath());
        }

        $title = 'Select Application | ' . APP_NAME;
        $description = 'Select Application | ' . APP_NAME;
        $details = details($title, $description);
        return view(
            'backend.applicant.select-application',
            compact('details', 'guest')
        );
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
        $result = !\AppHelper::validateKey(
            'case_categories',
            strtoupper($case_category_key)
        );
        abort_if($result, 404);

        $case = $guest->case;

        // Check if case has been submitted
        if ($case->isSubmitted()) {
            return redirect($guest->submittedApplicationPath());
        }

        // Save selected case category
        $case->saveCategory($case_category_key);

        $case_category = $case->getCategoryText();
        $case_parties = $case->getCaseParties(false);
        $checklistIds = $case->getChecklistIds();
        $checklistGroupDocuments = $case->getChecklistGroupDocuments();

        $title = "{$case_category} Application | " . APP_NAME;
        $description = "{$case_category} Application | " . APP_NAME;
        $details = details($title, $description);
        return view(
            'backend.applicant.create-application',
            compact(
                'details',
                'guest',
                'case',
                'case_category',
                'case_parties',
                'checklistIds',
                'checklistGroupDocuments'
            )
        );
    }

    /**
     * Send response.
     *
     * @param string $message
     * @param string $responseType
     * @param mixed $response
     * @return void
     */
    public function sendResponse(
        string $message,
        string $responseType,
        $response = null
    ) {
        echo json_encode([
            'message' => $message,
            'responseType' => $responseType,
            'response' => $response,
        ]);
        exit();
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
        if (!in_array($action, array_keys($this->methods))) {
            $this->sendResponse(
                'Something went wrong, please try again',
                'error'
            );
        }

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
            request('case_type')
        );

        $this->sendResponse('Case info saved.', 'success', $guest->case);
    }

    public function saveContactInfo(Guest $guest)
    {
        $guest->case->saveContactInfo(
            (object) [
                'applicant_firm' => request('applicant_firm'),
                'applicant_fullname' => request('applicant_fullname'),
                'applicant_email' => request('applicant_email'),
                'applicant_phone_number' => request('applicant_phone_number'),
                'applicant_address' => request('applicant_address'),
            ]
        );

        $this->sendResponse('Contact info saved.', 'success', $guest->case);
    }

    public function saveChecklistDocument(Guest $guest)
    {
        if (!request()->hasFile('file')) {
            $this->sendResponse('No file has been uploaded.', 'error', []);
        }

        $file = request('file');
        $extension = $file->getClientOriginalExtension();
        $newFileName = \SerialNumber::randomFileName($extension);
        $path = $file->storeAs('public/documents', $newFileName);

        $previous_document = Document::find(request('document_id'));
        if ($previous_document):
            unlink(
                storage_path('app/public/documents/' . $previous_document->file)
            );
            Document::destroy($previous_document->id);
        endif;
        $document = Document::create([
            'case_id' => $guest->case->id,
            'file' => $newFileName,
            'additional_info' => trim(request('additional_info')),
        ]);

        $checklistIds = request('checklists');
        $arrayOfChecklistIds = transformChecklistIds($checklistIds, [
            'selected_at' => now(),
        ]);
        $document->checklists()->syncWithoutDetaching($arrayOfChecklistIds);
        $this->sendResponse('Document has been saved.', 'success', $document);
    }

    /**
     * Submit case.
     *
     * @param Guest $guest
     * @return void
     */
    public function submit(Guest $guest)
    {
        $case = $guest->case;

        if (
            is_null($case->subject) ||
            is_null($case->parties) ||
            is_null($case->case_category) ||
            is_null($case->case_type) ||
            is_null($case->applicant_firm) ||
            is_null($case->applicant_fullname) ||
            is_null($case->applicant_email) ||
            is_null($case->applicant_phone_number) ||
            is_null($case->applicant_address)
        ):
            $this->sendResponse('Provide required fields.', 'error');
        endif;

        $guest->case->submit();

        $case = $guest->case;
        try {
            Mail::to($guest->email)->send(
                new ApplicationRequest([
                    'fullname' => $case->applicant_fullname,
                    'ref_no' => $case->ref_no,
                    'case' => $case,
                    'guest' => $guest,
                ])
            );
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        }
        $this->sendResponse('Application submitted.', 'success', $case);
    }

    /**
     * Handles application submitted page route.
     *
     * @param Guest $guest
     * @return \Illuminate\Contracts\View\Factory
     */
    public function applicationSubmitted(Guest $guest)
    {
        if (!$guest->case->isSubmitted()) {
            return redirect($guest->applicationPath());
        }

        $title = 'Application Submitted | ' . APP_NAME;
        $description = 'Application Submitted | ' . APP_NAME;
        $details = details($title, $description);
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
        if (!$guest->case->isSubmitted()) {
            return redirect($guest->submittedApplicationPath());
        }

        $isDeficient = $guest->case->isDeficient();
        $case = $guest->case;
        $checklistIds = $case->getChecklistIds();
        $checklistGroupDocuments = $case->getChecklistGroupDocuments();
        $newDeficientGroupIds = $case->getDeficientGroupIds();

        $title = 'Upload Documents | ' . APP_NAME;
        $description = 'Upload Documents | ' . APP_NAME;
        $details = details($title, $description);
        return view(
            'backend.applicant.upload-documents',
            compact(
                'details',
                'guest',
                'isDeficient',
                'case',
                'checklistIds',
                'checklistGroupDocuments',
                'newDeficientGroupIds'
            )
        );
    }

    /**
     * Handles Review application page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function review(Guest $guest, $step)
    {
        $case = $guest->case;
        $checklistIds = $case->getChecklistIds();
        $checklistGroupDocuments = $case->getChecklistGroupDocuments();
        $documents = Document::where('case_id', $guest->case->id)->get();
        $title = 'Review Application | ' . APP_NAME;
        $description = 'Review Application | ' . APP_NAME;
        $details = details($title, $description);
        return view(
            'backend.applicant.review',
            compact(
                'details',
                'guest',
                'step',
                'case',
                'documents',
                'checklistIds',
                'checklistGroupDocuments'
            )
        );
    }

    /**
     * Handles Checklist page.
     *
     * @param Guest $guest
     * @return \Illuminate\Contracts\View\Factory
     */
    public function checklistDocuments(Guest $guest, $case_category)
    {
        $title          = 'Checklist Documents | '.APP_NAME;
        $description    = 'Checklist Documents | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.applicant.checklist-documents', compact('details', 'guest', 'case_category'));
    }
}
