<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Cases;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Mail\IssueDeficiencyEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Notifications\CaseActionNotifier;
use App\Notifications\IssueCaseDeficiency;

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
     * Handles search cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function searchCases()
    {
        $search = $_GET['search'] ?? '';
        if (auth()->user()->account_type == 'CH'):
            $cases = auth()->user()->search_active_cases_assigned_to($search);
        elseif (auth()->user()->account_type == 'AD'):
            $data = auth()->user()->search_users_and_faqs($search);
        else:
            $cases = (new Cases())->searchAssignedCases($search);
        endif;

        $output = '';
        if (auth()->user()->account_type == 'AD'):
            if (count($data->users) <= 0 && count($data->faqs) <= 0):
                $output .= '<div class="text-muted text-center">No record found</div>';
            else:
                if (count($data->users) > 0):
                    $output .= '<div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                                    Members
                                </div>';
                    $output .= '<div class="mb-10">';

                    foreach ($data->users as $user):
                        $output .= '<div class="d-flex align-items-center flex-grow-1 mb-2">
                                        <div class="symbol symbol-30 bg-transparent flex-shrink-0">
                                            <i class="la la-user-alt icon-xl"></i>
                                        </div>';
                        $output .= '<div class="d-flex flex-column ml-3 mt-2 mb-2">';
                        $output .= '<a href="'.route('dashboard.profile', ['user' => $user->id]).'" class="font-weight-bold text-dark text-hover-primary">'.$user->getFullName().'</a>';
                        $output .= '<span class="font-size-sm font-weight-bold text-muted">
                                        '.$user->getAccountType().'
                                    </span>';
                        $output .= '</div>
                                    </div>';
                    endforeach;

                    $output .= '</div>';
                else:
                    $output .= '<div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                                    Members
                                </div>';
                    $output .= '<div class="mb-10">';
                    $output .= '<div class="text-muted text-center">No record found</div>';
                    $output .= '</div>';
                endif;

                if (count($data->faqs) > 0):
                    $output .= '<div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                                    Faqs
                                </div>';
                    $output .= '<div class="mb-10">';

                    foreach ($data->faqs as $faq):
                        $output .= '<div class="d-flex align-items-center flex-grow-1 mb-2">
                                        <div class="symbol symbol-30 bg-transparent flex-shrink-0">
                                            <i class="la la-question-circle-o icon-xl"></i>
                                        </div>';
                        $output .= '<div class="d-flex flex-column ml-3 mt-2 mb-2">';
                        $output .= '<a href="'.route('faq.faq_detail', ['faq' => $faq->id]).'" class="font-weight-bold text-dark text-hover-primary">'.$faq->getQuestion(60).'</a>';
                        $output .= '<span class="font-size-sm font-weight-bold text-muted">
                                        '.$faq->getSubmittedAt().'
                                    </span>';
                        $output .= '</div>
                                    </div>';
                    endforeach;

                    $output .= '</div>';
                else:
                    $output .= '<div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                                    Faqs
                                </div>';
                    $output .= '<div class="mb-10">';
                    $output .= '<div class="text-muted text-center">No record found</div>';
                    $output .= '</div>';
                endif;
            endif;
        else:
            if ($cases->count() <= 0):
                $output .= '<div class="text-muted text-center">No record found</div>';
            else:
                $output .= '<div class="font-size-sm text-primary font-weight-bolder text-uppercase mb-2">
                                Cases
                            </div>';
                $output .= '<div class="mb-10">';

                foreach ($cases as $case):
                    $output .= '<div class="d-flex align-items-center flex-grow-1 mb-2">
                                    <div class="symbol symbol-30 bg-transparent flex-shrink-0">
                                        <i class="la la-file-alt icon-xl"></i>
                                    </div>';
                    $output .= '<div class="d-flex flex-column ml-3 mt-2 mb-2">
                                        <a href="'.route('cases.analyze', ['case' => $case->id]).'" class="font-weight-bold text-dark text-hover-primary">'.shortenContent($case->subject, 60).'</a>';
                    $output .= '<span class="font-size-sm font-weight-bold text-muted">
                                    by '.$case->getApplicantFullName().'
                                </span>';
                    $output .= '</div>
                                </div>';
                endforeach;

                $output .= '</div>';
            endif;
        endif;

        echo $output;
    }

    /**
     * Handles unassigned cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function unassignedCases()
    {
        if (auth()->user()->isAdmin())
            return redirect()->back();

        $cases          = (new Cases())->unassignedCases();
        $caseHandlers   = (new User())->caseHandlers();

        $title          = 'New Cases | ' . APP_NAME;
        $description    = 'New Cases | ' . APP_NAME;
        $details        = details($title, $description);
        return view(
            'backend.cases.unassigned',
            compact('details', 'cases', 'caseHandlers')
        );
    }

    /**
     * Handles all cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function allCases(User $handler)
    {
        if (auth()->user()->isAdmin())
            return redirect()->back();

        if (isset($handler->status)):
            $cases = $handler->all_cases(TRUE)->get();
        else:
            $cases = auth()->user()->all_cases()->get();
        endif;

        $caseHandlers   = (new User())->caseHandlers();

        $title          = 'All Cases | ' . APP_NAME;
        $description    = 'All Cases | ' . APP_NAME;
        $details        = details($title, $description);
        return view(
            'backend.cases.cases-all',
            compact('details', 'cases', 'caseHandlers')
        );
    }

    /**
     * Handles assigned cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function assignedCases(User $handler)
    {
        if (auth()->user()->isAdmin())
            return redirect()->back();

        if (isset($handler->status)):
            $cases = $handler->active_cases_assigned(TRUE)->get();
        else:
            $cases = auth()->user()->active_cases_assigned()->get();
        endif;

        $caseHandlers = (new User())->caseHandlers();

        $title          = 'Assigned Cases | ' . APP_NAME;
        $description    = 'Assigned Cases | ' . APP_NAME;
        $details        = details($title, $description);
        return view(
            'backend.cases.cases-assigned',
            compact('details', 'cases', 'caseHandlers')
        );
    }

    /**
     * Handles dropped cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function droppedCases(User $handler)
    {
        if (auth()->user()->isAdmin())
            return redirect()->back();

        $cases          = $handler->dropped_cases_assigned_to()->get();
        $caseHandlers   = (new User())->caseHandlers();

        $title          = 'Dropped Cases | ' . APP_NAME;
        $description    = 'Dropped Cases | ' . APP_NAME;
        $details        = details($title, $description);
        return view(
            'backend.cases.cases-dropped',
            compact('details', 'cases', 'caseHandlers')
        );
    }

    /**
     * Handles workingon cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function workingonCases(User $handler)
    {
        if (auth()->user()->isAdmin())
            return redirect()->back();

        if ($handler->status):
            $cases = $handler->cases_working_on(TRUE)->get();
        else:
            $cases = \Auth::user()->cases_working_on()->get();
        endif;

        $caseHandlers   = (new User())->caseHandlers();
        $title          = 'Ongoing Cases | ' . APP_NAME;
        $description    = 'Ongoing Cases | ' . APP_NAME;
        $details        = details($title, $description);
        return view(
            'backend.cases.cases-working-on',
            compact('details', 'caseHandlers', 'cases')
        );
    }

    /**
     * Handles approved cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function approvedCases(User $handler)
    {
        if (auth()->user()->isAdmin())
            return redirect()->back();

        if ($handler->status):
            $cases = $handler->approved_cases(TRUE)->get();
        else:
            $cases = \Auth::user()->approved_cases()->get();
        endif;

        $caseHandlers   = (new User())->caseHandlers();

        $title          = 'Approved Cases | ' . APP_NAME;
        $description    = 'Approved Cases | ' . APP_NAME;
        $details        = details($title, $description);
        return view(
            'backend.cases.cases-approved',
            compact('details', 'cases', 'caseHandlers')
        );
    }

    /**
     * Handles cases on hold page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function onholdCases(User $handler)
    {
        if (auth()->user()->isAdmin())
            return redirect()->back();

        if ($handler->status):
            $cases = $handler->deficient_cases(TRUE)->get();
        else:
            $cases = \Auth::user()->deficient_cases()->get();
        endif;

        $caseHandlers   = (new User())->caseHandlers();
        $title          = 'Cases On hold| ' . APP_NAME;
        $description    = 'Cases On hold| ' . APP_NAME;
        $details        = details($title, $description);
        return view(
            'backend.cases.cases-on-hold',
            compact('details', 'cases', 'caseHandlers')
        );
    }

    /**
     * Handles archived cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function archivedCases()
    {
        if (auth()->user()->isAdmin())
            return redirect()->back();

        $cases          = (new Cases())->archivedCases();
        $caseHandlers   = (new User())->caseHandlers();

        $title          = 'Archived Cases | ' . APP_NAME;
        $description    = 'Archived Cases | ' . APP_NAME;
        $details        = details($title, $description);
        return view(
            'backend.cases.cases-archived',
            compact('details', 'cases', 'caseHandlers')
        );
    }

    /**
     * Handles archive case page.
     *
     * @return void
     */
    public function archiveCase(Cases $case)
    {
        if (auth()->user()->isAdmin())
            return redirect()->back();

        $active_case_handler    = $case->active_handlers->first()->case_handler;
        $case_handler           = User::find($active_case_handler->handler_id);
        $supervisor             = User::find($active_case_handler->supervisor_id);

        $case->archive($case_handler);

        // Notify case handler
        $case_handler->notify(new CaseActionNotifier(
            'archive',
            'Case has been archived.',
            $case->id
        ));

        // Notify supervisor
        $supervisor->notify(new CaseActionNotifier(
            'archive',
            "Case has been archived.",
            $case->id
        ));

        return redirect()->back()->with('success', 'Case archived!');
    }

    /**
     * Handles the case analysis page route.
     *
     * @return void
     */
    public function analyzeCase(Cases $case)
    {
        $authUser = auth()->user();

        if ($authUser->isAdmin())
            return redirect()->back();

        if ($authUser->isCaseHandler()):
            if (!$case->active_handlers->first()->isUserSame($authUser))
                return redirect()->back();
        endif;

        $caseHandlers   = (new User())->caseHandlers();
        $title          = APP_NAME;
        $description    = 'FCCPC Case Analysis Dashboard';
        $details        = details($title, $description);
        return view('backend.cases.analyze-case', compact('details', 'case', 'caseHandlers'));
    }

    /*
     * Handles the checklist approval page route.
     *
     * @return void
     */
    public function checklistApproval(Cases $case, $date)
    {
        if (auth()->user()->isAdmin())
            return redirect()->back();

        $checklistIds           = $case->getChecklistIds();
        $submittedDocuments     = $case->submittedDocuments()[$date];
        $checklistStatus        = $case->getSubmittedDocumentChecklistByDateAndStatus($date, 'deficient');

        $title          = APP_NAME;
        $description    = 'FCCPC Checklist Approval Dashboard';
        $details        = details($title, $description);
        return view(
            'backend.cases.checklist-approval',
            compact('details', 'case', 'checklistIds', 'submittedDocuments', 'checklistStatus', 'date')
        );
    }

    /*
     * Handles the get checklist count page route.
     *
     * @return void
     */
    public function getChecklistCount(Cases $case, $date)
    {
        $this->sendResponse('Case checklist status count.', 'success', [
            'deficient_cases'   => $case->getSubmittedDocumentChecklistByDateAndStatus($date, 'deficient')->count(),
            'approved_cases'    => $case->getSubmittedDocumentChecklistByDateAndStatus($date, 'approved')->count(),
        ]);
    }

    /*
     * Handles the get submitted checklist by status route.
     *
     * @return void
     */
    public function getChecklistByStatus(Cases $case, $date)
    {
        $this->sendResponse('Case checklist by status.', 'success', [
            'deficient_cases'   => $case->getSubmittedDocumentChecklistByDateAndStatus($date, 'deficient'),
            'approved_cases'    => $case->getSubmittedDocumentChecklistByDateAndStatus($date, 'approved'),
        ]);
    }

    /**
     * Update document checklist status.
     *
     * @return json
     */
    public function saveChecklistApproval(Document $document)
    {
        $case       = $document->case;
        $checklist  = request('checklist');
        if (request('remove_checklist') == 'yes'):
            $document->checklists()->detach([$checklist]);
        else:
            $document->checklists()->syncWithoutDetaching([$checklist => ['status' => request('status')]]);
        endif;
        return $this->sendResponse(200, "Checklist document updated", "success", [
            'case_group_documents' => $case->getChecklistGroupDocuments()
        ]);
    }

    /**
     * Handles issuing of deficiency
     *
     * @return json
     */
    public function issueDeficiency(Cases $case, $date)
    {
        $active_case_handler    = $case->active_handlers->first()->case_handler;
        $case_handler           = User::find($active_case_handler->handler_id);
        $supervisor             = User::find($active_case_handler->supervisor_id);
        $emails                 = ($case->guest->email == $case->applicant_email)
                                ? [$case->applicant_email]
                                : [$case->applicant_email, $case->guest->email];

        // Issue deficiency
        $case->issueDeficiency($case_handler);
        // Notify case handler
        Mail::to($emails)
            ->send(new IssueDeficiencyEmail([
                'fullname'        => $case->applicant_fullname,
                'ref_no'          => $case->guest->tracking_id,
                'deficent_cases'  => $case->getSubmittedDocumentChecklistByDateAndStatus($date, 'deficient'),
                'additional_info' => request('additional_info'),
            ]));
        $case_handler->notify(new IssueCaseDeficiency(
            'onhold',
            "Deficiency has been issued.", $case->id
        ));
        // Notify supervisor
        $supervisor->notify(new IssueCaseDeficiency(
            'onhold',
            "Deficiency has been issued by <b>{$case_handler->getFullName()}</b>.", $case->id
        ));
        return $this->sendResponse('Deficieny sent.', 'success');
    }

    /**
     * Handles approving of checklists
     *
     * @return json
     */
    public function approveChecklists(Cases $case)
    {
        $handler = User::find($case->active_handlers->first()->id);
        $case->removeDeficiency($handler);
        $case->approveChecklists($handler);

        return $this->sendResponse('Checklists approved.', 'success');
    }

    /**
     * Handles issuing of recommedation
     *
     * @return json
     */
    public function issueRecommendation(Cases $case)
    {
        $validator              = $this->validate(request(), [
            'file'              => 'required',
            'recommendation'    => 'required',
        ]);

        if (!$validator):
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        endif;

        if (!empty($case->getAnalysisDocument())):
            unlink(storage_path('app/public/analysis_documents/'.$case->getAnalysisDocument()));
        endif;

        $file           = request('file');
        $recommendation = request('recommendation');
        $extension      = $file->getClientOriginalExtension();
        $newFileName    = \SerialNumber::randomFileName($extension);
        $path           = $file->storeAs('public/analysis_documents', $newFileName);

        $handler = User::find($case->active_handlers->first()->id);
        $case->issueReccomendation($handler, $newFileName, $recommendation);

        return redirect()->back()->with('success', 'Recommendation has been uploaded!');
    }

    /**
     * Handles requesting of approval
     *
     * @return json
     */
    public function requestApproval(Cases $case)
    {
        $active_case_handler    = $case->active_handlers->first()->case_handler;
        $case_handler           = User::find($active_case_handler->handler_id);
        $supervisor             = User::find($active_case_handler->supervisor_id);

        // Notify case handler
        $case_handler->notify(new CaseActionNotifier(
            'request',
            'Your approval request has been sent.',
            $case->id
        ));

        // Notify supervisor
        $supervisor->notify(new CaseActionNotifier(
            'request',
            "{$case_handler->getFullName()} has requested approval.",
            $case->id
        ));

        $handler = User::find($case->active_handlers->first()->id);
        $case->issueApprovalRequest($handler);

        return redirect()->back()->with('success', 'Approval requested!');
    }

    /**
     * Handles recommendation resolving by supervisor
     *
     * @return json
     */
    public function resolveRecommendation(Cases $case)
    {
        $status       = \AppHelper::value('recommendation_types', request('status'), 'strtolower');
        $status_type  = ($status == 'approved') ? 'success' : 'error';
        $comment      = empty(request('comment')) ? NULL : request('comment');
        $request_type = ($status == 'approved') ? 'request_approved' : 'request_rejected';

        $active_case_handler    = $case->active_handlers->first()->case_handler;
        $case_handler           = User::find($active_case_handler->handler_id);
        $supervisor             = User::find($active_case_handler->supervisor_id);

        // Notify case handler
        $case_handler->notify(new CaseActionNotifier(
            $request_type,
            "Your approval request has been {$status}.",
            $case->id
        ));

         // Notify supervisor
        $supervisor->notify(new CaseActionNotifier(
            $request_type,
            "{$case_handler->getFullName()} request has been {$status}.",
            $case->id
        ));

        $handler = User::find($case->active_handlers->first()->id);
        $case->issueApprovalComment($handler, $comment, $status);

        return redirect()->back()->with($status_type, "Request has been {$status}!");
    }

    /**
     * Handles the case analysis case documents page route.
     *
     * @return void
     */
    public function analyzeCaseDocuments(Cases $case)
    {
        if (auth()->user()->isAdmin())
            return redirect()->back();

        if (\Auth::user()->active_cases_assigned_to_all()->where('case_id', $case->id)->count() <= 0 && !in_array(\Auth::user()->account_type, ['SP']))
            return redirect()->route('cases.assigned');

        $checklistGroupDocuments    = $case->getChecklistGroupDocuments();
        $title                      = APP_NAME;
        $description                = 'FCCPC Case Documents Analysis Dashboard';
        $details                    = details($title, $description);
        return view(
            'backend.cases.analyze-case-documents',
            compact('details', 'case', 'checklistGroupDocuments')
        );
    }

    /**
     * Handles the case assign page route.
     *
     * @return void
     */
    public function assignCase(Cases $case, User $user)
    {
        abort_if(!auth()->user(), 404);
        $case->assign($user);
        // Notify case handler
        $user->notify(new CaseActionNotifier(
            'assign',
            'A new case has been assigned to you.',
            $case->id
        ));
        // Notify supervisor
        auth()->user()->notify(new CaseActionNotifier(
            'assign',
            "Case has been assigned to <b>{$user->getFullName()}</b>.",
            $case->id
        ));
        $this->sendResponse('Case assigned.', 'success', [
            'case'      => $case,
            'handler'   => $user,
        ]);
    }

    /**
     * Handles the case unassign page route.
     *
     * @return void
     */
    public function unassignCase(Cases $case, User $user)
    {
        abort_if(!auth()->user(), 404);
        $case->disolve($user);

        // Notify case handler
        $user->notify(new CaseActionNotifier(
            'unassign',
            'Your case has been unassigned',
            $case->id
        ));
        // Notify supervisor
        auth()
            ->user()
            ->notify(new CaseActionNotifier(
                'unassign',
                "Case has been unassigned from <b>{$user->getFullName()}</b>.",
                $case->id
            ));
        $this->sendResponse('Case unassigned.', 'error');
    }

    /**
     * Handles the case reassign page route.
     *
     * @return void
     */
    public function reassignCase(Cases $case, User $oldUser, User $newUser)
    {
        abort_if(!auth()->user(), 404);
        $case->reAssign($oldUser, $newUser);

        // Notify old case handler
        $oldUser->notify(new CaseActionNotifier(
            'reassign',
            'Your case has been reassigned',
            $case->id
        ));
        // Notify new case handler
        $newUser->notify(new CaseActionNotifier(
            'assign',
            'A new case has been assigned to you.',
            $case->id
        ));
        // Notify supervisor
        auth()
            ->user()
            ->notify(new CaseActionNotifier(
                'reassign',
                "Case has been reassigned to <b>{$newUser->getFullName()}</b>.",
                $case->id
            ));
        $this->sendResponse('Case reassigned.', 'success');
    }

    /**
     * Handles the update case working on .
     *
     * @return void
     */
    public function updateWorkingOn(Cases $case, User $user)
    {
        abort_if(!auth()->user(), 404);
        $case->update_working_on($user);
        $this->sendResponse('Case working on updated.', 'success');
    }

    /**
     * Handles the case checklists page route.
     *
     * @return void
     */
    public function caseChecklists(Cases $case)
    {
        $checklists = $case->getChecklistName();
        abort_if(!auth()->user(), 404);

        $this->sendResponse('Case checklists received.', 'success', [
            'checklists' => $checklists,
        ]);
    }

    /**
     * Handles the case documents page route.
     *
     * @return void
     */
    public function caseDocuments(Cases $case)
    {
        $documents = $case->getChecklistGroupDocuments();
        abort_if(!auth()->user(), 404);

        $this->sendResponse('Case documents received.', 'success', [
            'documents' => $documents,
            'group'     => $case->getChecklistGroupName(),
        ]);
    }

    /**
     * Handles the get document icon text page route.
     *
     * @return void
     */
    public function getDocumentIconText(Document $document)
    {
        abort_if(!auth()->user(), 404);

        $this->sendResponse('Document Icon received.', 'success', [
            'icon' => $document->getIconText(),
        ]);
    }

    /**
     * Handles the case update status page route.
     *
     * @return void
     */
    public function updateCaseStatus($status, $id)
    {
        Cases::whereId($id)->update([
            'status' => $status,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Transaction status has been updated');
    }

    /**
     * Handles the download analysis document route
     *
     * @return void
     */
    public function downloadAnalysisDocument($document)
    {
        return response()->download(storage_path("app/public/analysis_documents/{$document}"));
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
}
