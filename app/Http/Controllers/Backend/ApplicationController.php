<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Cases;
use App\Models\Guest;
use App\Models\Document;
use Illuminate\Support\Str;
use App\Models\ChecklistGroup;
use App\Notifications\NewUser;
use App\Mail\ApplicationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Notifications\CaseActionNotifier;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NotifyHandlerForDeficientCaseSubmission;

class ApplicationController extends Controller
{
    protected $methods                      = [
        'saveForm1AInfo'                    => 'saveForm1AInfo',
        'saveCaseInfo'                      => 'saveCaseInfo',
        'saveContactInfo'                   => 'saveContactInfo',
        'saveChecklistDocument'             => 'saveChecklistDocument',
        'saveDeficientChecklistDocument'    => 'saveDeficientChecklistDocument',
    ];

    public function test()
    {
        $case           = Cases::find(29);
        $user           = auth()->user();
        // $oldUser        = User::find(6);
        // $newUser        = User::find(11);
        // $supervisor     = User::find(5);
        // return $case->reAssign($oldUser, $newUser, $supervisor);

        // foreach (User::all() as $user)
        // {
        //     $user->notify(new NewUser(
        //         "newuser",
        //         "Hi {$user->getFirstName()}, Welcome to FCCPC - Mergers & Acquisition Platform.",
        //         $user,
        //         config('app.default_password')
        //     ));
        // }

        // $user->notifications[0]->markAsRead();
        // $user->notifications()->where('id', "fca8faa8-1557-490c-ba6b-9e48c339caba")->markAsRead();

        // foreach (Cases::all() as $case)
        // {
        //     $case->subject = str_split($case->subject, 50)[0];
        //     $case->amount_paid = rand(5000000, 10000000);
        //     $case->save();
        // }

        // $documents = [];
        // foreach (Cases::all() as $case)
        // {
        //     foreach ($case->documents as $document)
        //     {
        //         $document->date_case_submitted = $case->submitted_at;
        //         $document->group_id = (!$document->checklists->isEmpty())
        //             ? $document->checklists->first()->group->id
        //             : NULL;
        //         $document->save();
        //         $documents[] = $document;
        //     }
        // }

        // $submittedDocuments = $case->submittedDocuments();
        // foreach ($submittedDocuments as $date => $documents)
        // {
        //     foreach ($documents as $document)
        //     {
        //         $checklists = $document->checklists;
        //         $group      = $document->group;
        //     }
        // }
        // $date = "2020-11-17 09:40:46";
        // $submittedDocument = $case->getSubmittedDocumentByDate($date);

        return [
            'applicationforms'      => $case->formatApplicationForms(),
            'notifications'         => $user->notifications,
            'unreadNotifications'   => $user->unreadNotifications,
            'readNotifications'     => $user->readNotifications,

            // $documents,
            // $case,
            // $case->documents,
            // $case->guest,
            // $case->isDeficient(),
            // $case->getDeficientGroupIds(),
            // $case->getCaseSubmittedChecklistByStatus('deficient'),
            // Gets all latest submitted document checklist, either approved, deficient or null
            // $case->getLatestSubmittedDocumentChecklists(),
            // Gets all latest submitted document checklist by specified status, default is deficient
            // $case->getLatestSubmittedDocumentChecklistsByStatus('deficient')->groupBy('group_id')->toArray(),
            // Gets all latest submitted document checklist IDs by specified status, default is deficient
            // $case->getLatestSubmittedDocumentChecklistsIDs('deficient'),
            // Gets all latest submitted document checklist group IDs by specified status, default is deficient
            // $case->getLatestSubmittedDocumentChecklistsGroupIDs('deficient'),
            // Gets all latest submitted document checklist groups by specified status, default is deficient
            // $case->getLatestSubmittedDocumentChecklistsGroups('deficient'),
            // Gets all latest submitted document checklist group names by specified status, default is deficient
            // $case->getLatestSubmittedDocumentChecklistsGroupNames('deficient'),

            // $submittedDocuments,
            // $submittedDocument,
            // $case->getSubmittedDocumentChecklistByDateAndStatus($date),
            // $case->unSubmittedDocuments(),
            // $case->getChecklistGroupUnSubmittedDocuments(),
            // $case->getChecklistGroupUnSubmittedDocumentsName(),
        ];
    }

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
        $filteredChecklistGroup = ChecklistGroup::where('category', $case_category_key)
                                    ->get()
                                    ->reject(function($checklistGroup)
                                    {
                                        return $checklistGroup->name === "Fees";
                                    });
        $filteredChecklistGroupFees = ChecklistGroup::where('category', 'ALL')
            ->get()
            ->reject(function($checklistGroup)
            {
                return $checklistGroup->name !== "Fees";
            });

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
                'case_category_key',
                'case_category',
                'case_parties',
                'checklistIds',
                'filteredChecklistGroup',
                'filteredChecklistGroupFees',
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

    /**
     * Save Form 1A info.
     *
     * @param Guest $guest
     * @return void
     */
    public function saveForm1AInfo(Guest $guest)
    {
        $form_text       = !empty(request('form_text')) ? request('form_text') : '';
        $name            = !empty(request('name')) ? request('name') : '';
        $position        = !empty(request('position')) ? request('position') : '';
        $guest->case->saveForm1AInfo(
            $form_text,
            $name,
            $position
        );

        $this->sendResponse('Form 1A info saved.', 'success', $guest->case);
    }

    /**
     * Save case info.
     *
     * @param Guest $guest
     * @return void
     */
    public function saveCaseInfo(Guest $guest)
    {
        $parties = is_array(request('parties')) ? request('parties') : [];

        $guest->case->saveCaseInfo(
            request('subject'),
            implode(':', $parties),
            request('case_type')
        );

        $this->sendResponse('Transaction info saved.', 'success', $guest->case);
    }

    /**
     * Save case contact info.
     *
     * @param Guest $guest
     * @return void
     */
    public function saveContactInfo(Guest $guest)
    {
        $fileName = '';
        $previous_document_name = request('previous_document_name') ?? '';

        if (request()->hasFile('file')):
            $validator = Validator::make(request()->all(), [
            'file' => 'mimes:pdf',
            ]);

            if ($validator->fails())
                $this->sendResponse('Only PDF file format is supported.', 'error', []);

            $file = request('file');
            $extension = $file->getClientOriginalExtension();
            $fileName = \SerialNumber::randomFileName($extension);
            $path = $file->storeAs('public/documents', $fileName);

            $previous_document = Cases::where('id', $guest->case->id)->where('letter_of_appointment', $previous_document_name)->first();
            if ($previous_document):
                $old_file = $previous_document->letter_of_appointment;
                if (checkFile(storage_path('app/public/documents/'.$old_file)))
                    unlink(storage_path('app/public/documents/'.$old_file));
            endif;
        endif;

        $guest->case->saveContactInfo(
            (object) [
                'applicant_firm' => request('applicant_firm'),
                'applicant_fullname' => request('applicant_fullname'),
                'applicant_email' => request('applicant_email'),
                'applicant_phone_number' => request('applicant_phone_number'),
                'applicant_address' => request('applicant_address'),
                'letter_of_appointment' => empty($fileName) ? $previous_document_name : $fileName,
            ]
        );

        $this->sendResponse('Contact info saved.', 'success', $guest->case);
    }

    /**
     * Save case checklist document.
     *
     * @param Guest $guest
     * @return void
     */
    public function saveChecklistDocument(Guest $guest)
    {
        if (!empty(request('application_fee')) && !empty(request('processing_fee')) && !empty(request('amount_paid'))):
            $application_fee  = str_replace(',', '', request('application_fee'));
            $processing_fee   = str_replace(',', '', request('processing_fee'));
            $expedited_fee    = str_replace(',', '', request('expedited_fee'));
            $amount_paid      = str_replace(',', '', request('amount_paid'));

            $guest->case->saveFeeInfo(
                (object) [
                    'application_fee' => $application_fee,
                    'processing_fee'  => $processing_fee,
                    'expedited_fee'   => $expedited_fee,
                    'amount_paid'     => $amount_paid,
                ]
            );
        endif;

        if (!request()->hasFile('files')) {
            $this->sendResponse('No file has been uploaded.', 'warning', []);
        }

        $previous_document = Document::find(request('document_id'));

        if ($previous_document):
            $previous_file_array = explode(',', $previous_document->file);
            foreach ($previous_file_array as $key => $file):
                if (checkFile(storage_path('app/public/documents/'.$file)))
                    unlink(storage_path('app/public/documents/'.$file));
            endforeach;
            Document::destroy($previous_document->id);
        endif;

        foreach (request('files') as $key => $file):
            if (!empty($file)):
                $extension    = $file->getClientOriginalExtension();
                $newFileName  = \SerialNumber::randomFileName($extension);
                $path         = $file->storeAs('public/documents', $newFileName);
                $file_array[] = $newFileName;
            endif;
        endforeach;

        $document = Document::create([
            'case_id'         => $guest->case->id,
            'group_id'        => request('group_id'),
            'file'            => implode(',', $file_array),
            'additional_info' => trim(request('additional_info')),
        ]);

        $this->sendResponse('Document has been saved.', 'success', $document);
    }

    /**
     * Save case deficient checklist document.
     *
     * @param Guest $guest
     * @return void
     */
    public function saveDeficientChecklistDocument(Guest $guest)
    {
        if (!empty(request('application_fee')) && !empty(request('processing_fee')) && !empty(request('amount_paid'))):
            $application_fee  = str_replace(',', '', request('application_fee'));
            $processing_fee   = str_replace(',', '', request('processing_fee'));
            $expedited_fee    = str_replace(',', '', request('expedited_fee'));
            $amount_paid      = str_replace(',', '', request('amount_paid'));

            $guest->case->saveFeeInfo(
                (object) [
                    'application_fee' => $application_fee,
                    'processing_fee'  => $processing_fee,
                    'expedited_fee'   => $expedited_fee,
                    'amount_paid'     => $amount_paid,
                ]
            );
        endif;

        if (!request()->hasFile('files')) {
            $this->sendResponse('No file has been uploaded.', 'warning', []);
        }

        $previous_document = Document::find(request('document_id'));

        if ($previous_document):
            $previous_file_array = explode(',', $previous_document->file);
            foreach ($previous_file_array as $key => $file):
                if (checkFile(storage_path('app/public/documents/'.$file)))
                    unlink(storage_path('app/public/documents/'.$file));
            endforeach;
            Document::destroy($previous_document->id);
        endif;

        foreach (request('files') as $key => $file):
            if (!empty($file)):
                $extension    = $file->getClientOriginalExtension();
                $newFileName  = \SerialNumber::randomFileName($extension);
                $path         = $file->storeAs('public/documents', $newFileName);
                $file_array[] = $newFileName;
            endif;
        endforeach;

        $document = Document::create([
            'case_id'         => $guest->case->id,
            'group_id'        => request('group_id'),
            'file'            => implode(',', $file_array),
            'additional_info' => trim(request('additional_info')),
        ]);

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
        $case        = $guest->case;
        $supervisors = User::where('account_type', 'SP')->where('status', 'active')->get();

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

        $guest->case->saveDeclaration(
         (object) [
            'declaration_name' => request('declaration_name'),
            'declaration_rep'  => request('declaration_rep'),
         ]);

        $guest->case->submit();

        $case = $guest->case;

        Document::where('case_id', $case->id)->update([
            'date_case_submitted'          => $case->submitted_at,
        ]);

        try {
            Mail::to($guest->email)->send(
                new ApplicationRequest([
                    'fullname' => $case->applicant_fullname,
                    'ref_no' => $case->reference_number,
                    'case' => $case,
                    'guest' => $guest,
                ])
            );
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        }

        foreach ($supervisors as $supervisor):
             // Notify supervisor
            $supervisor->notify(new CaseActionNotifier(
                'newcase',
                "{$case->applicant_fullname} has created a new application.",
                $case->id
            ));
        endforeach;

        $this->sendResponse('Application submitted.', 'success', $case);
    }

    /**
     * Submit deficient case.
     *
     * @param Guest $guest
     * @return void
     */
    public function submitDeficient(Guest $guest)
    {
        $case                   = $guest->case;
        $active_case_handler    = $case->active_handlers->first()->case_handler;
        $case_handler           = User::find($active_case_handler->handler_id);
        $supervisor             = User::find($active_case_handler->supervisor_id);

        // Notify case handler
        $case_handler->notify(new NotifyHandlerForDeficientCaseSubmission(
            'defresponse',
            'Applicant has responded to deficient documents',
            $case
        ));
        // Notify supervisor
        $supervisor->notify(new NotifyHandlerForDeficientCaseSubmission(
            'defresponse',
            'Applicant has responded to deficient documents',
            $case
        ));

        Document::where('case_id', $case->id)
            ->where('date_case_submitted', null)
            ->update([
                'date_case_submitted' => now(),
            ]);

        $case->removeDeficiency($case_handler);
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
        $case                   = $guest->case;
        $isDeficient            = $case->isDeficient();
        $checklistIds           = $case->getLatestSubmittedDocumentChecklistsIDs('deficient');
        $deficientGroupIds      = $case->getLatestSubmittedDocumentChecklistsGroupIDs('deficient');

        $title          = 'Upload Documents | ' . APP_NAME;
        $description    = 'Upload Documents | ' . APP_NAME;
        $details        = details($title, $description);
        return view(
            'backend.applicant.upload-documents',
            compact(
                'details',
                'guest',
                'case',
                'isDeficient',
                'checklistIds',
                'deficientGroupIds',
            )
        );
    }

    /**
     * Download form.
     *
     * @param string $form
     * @return void
     */
    public function downloadForm($form)
    {
        $form_array = explode('.', $form);
        $file       = public_path()."/assets/forms/{$form}";
        $headers    = array('Content-Type: application/'.$form_array[1]);

        return response()->download($file, $form, $headers);
    }

    /**
     * Handles Review application page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function review(Guest $guest, $step)
    {
        if ($guest->case->isSubmitted()) {
            return redirect($guest->submittedApplicationPath());
        }

        $case                    = $guest->case;
        $checklistIds            = $case->getChecklistIds();
        $checklistGroupDocuments = $case->getChecklistGroupDocuments();
        $documents               = Document::where('case_id', $guest->case->id)->get();

        $title       = 'Review Application | ' . APP_NAME;
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
     * Handles Review Deficient application page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function reviewDeficient(Guest $guest, $step)
    {
        if (!$guest->case->isDeficient()) {
            return redirect($guest->submittedApplicationPath());
        }

        $case                    = $guest->case;
        $deficientGroupIds       = $case->getLatestSubmittedDocumentChecklistsGroupIDs('deficient');
        $unSubmittedDocuments    = $case->getChecklistGroupUnSubmittedDocuments();

        $title       = 'Review Application | ' . APP_NAME;
        $description = 'Review Application | ' . APP_NAME;
        $details = details($title, $description);
        return view(
            'backend.applicant.review-deficient',
            compact(
                'details',
                'guest',
                'step',
                'case',
                'deficientGroupIds',
                'unSubmittedDocuments'
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
