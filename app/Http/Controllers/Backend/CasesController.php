<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Cases;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Notifications\CaseAssigned;
use App\Mail\IssueDeficiencyEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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
        else:
            $cases = (new Cases())->searchAssignedCases($search);
        endif;

        $output = '';
        if ($cases->count() <= 0):
            $output .= '<p>No transaction found!</p>';
        else:
            foreach ($cases as $case):
                $output .= '<a href="'.route('cases.analyze', ['case' => $case->id]).'">'.shortenContent($case->subject, 40).'</a>';
            endforeach;
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
        $cases = (new Cases())->unassignedCases();

        $caseHandlers = (new User())->caseHandlers();

        $title = 'New Cases | ' . APP_NAME;
        $description = 'New Cases | ' . APP_NAME;
        $details = details($title, $description);
        return view(
            'backend.cases.unassigned',
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
        if (isset($handler->status)):
            $cases = $handler->active_cases_assigned_to()->get();
        else:
            if (auth()->user()->account_type == 'CH'):
                $cases = auth()
                    ->user()
                    ->active_cases_assigned_to()
                    ->get();
            else:
                $cases = \Auth::user()->active_cases_assigned_by()->get();
            endif;
        endif;

        $caseHandlers = (new User())->caseHandlers();

        $title = 'Assigned Cases | ' . APP_NAME;
        $description = 'Assigned Cases | ' . APP_NAME;
        $details = details($title, $description);
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
        $cases = $handler->dropped_cases_assigned_to()->get();
        $caseHandlers = (new User())->caseHandlers();

        $title = 'Dropped Cases | ' . APP_NAME;
        $description = 'Dropped Cases | ' . APP_NAME;
        $details = details($title, $description);
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
        if ($handler->status):
            $cases = $handler->cases_working_on(TRUE)->get();
        else:
            $cases = \Auth::user()->cases_working_on()->get();
        endif;

        $caseHandlers = (new User())->caseHandlers();
        $title = 'Ongoing Cases | ' . APP_NAME;
        $description = 'Ongoing Cases | ' . APP_NAME;
        $details = details($title, $description);
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
    public function approvedCases()
    {
        $cases = (new Cases())->assignedCases();
        $caseHandlers = (new User())->caseHandlers();

        $title = 'Approved Cases | ' . APP_NAME;
        $description = 'Approved Cases | ' . APP_NAME;
        $details = details($title, $description);
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
        if ($handler->status):
            $cases = $handler->deficient_cases(TRUE)->get();
        else:
            $cases = \Auth::user()->deficient_cases()->get();
        endif;

        $caseHandlers = (new User())->caseHandlers();
        $title = 'Cases On hold| ' . APP_NAME;
        $description = 'Cases On hold| ' . APP_NAME;
        $details = details($title, $description);
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
        $cases = (new Cases())->archivedCases();
        $caseHandlers = (new User())->caseHandlers();

        $title = 'Archived Cases | ' . APP_NAME;
        $description = 'Archived Cases | ' . APP_NAME;
        $details = details($title, $description);
        return view(
            'backend.cases.cases-archived',
            compact('details', 'cases', 'caseHandlers')
        );
    }

    /**
     * Handles the case analysis page route.
     *
     * @return void
     */
    public function analyzeCase(Cases $case)
    {
        $caseHandlers = (new User())->caseHandlers();
        $title = APP_NAME;
        $description = 'FCCPC Case Analysis Dashboard';
        $details = details($title, $description);
        return view('backend.cases.analyze-case', compact('details', 'case', 'caseHandlers'));
    }

    /*
     * Handles the checklist approval page route.
     *
     * @return void
     */
    public function checklistApproval(Cases $case, $date)
    {
        $checklistIds               = $case->getChecklistIds();
        $submittedDocuments         = $case->submittedDocuments()[$date];
        $checklistStatusCount       = (object) $case->getChecklistStatusCount();

        // return [$submittedDocuments->count()];
        // Checklist Objects
        // $case->getCaseSubmittedChecklistByStatus(); // NULL
        // $case->getCaseSubmittedChecklistByStatus('approval'); // approval
        // $case->getCaseSubmittedChecklistByStatus('deficient'); // deficient

        $title          = APP_NAME;
        $description    = 'FCCPC Checklist Approval Dashboard';
        $details        = details($title, $description);

        return view(
            'backend.cases.checklist-approval',
            compact('details', 'case', 'checklistIds', 'submittedDocuments', 'checklistStatusCount')
        );
    }

    /*
     * Handles the get checklist count page route.
     *
     * @return void
     */
    public function getChecklistCount(Cases $case)
    {
        $checklistStatusCount       = (object) $case->getChecklistStatusCount();
        $this->sendResponse('Case checklist status count.', 'success', $checklistStatusCount);
    }

    /*
     * Handles the get submitted checklist by status route.
     *
     * @return void
     */
    public function getChecklistByStatus(Cases $case)
    {
        $this->sendResponse('Case checklist by status.', 'success', [
            'deficent_cases' => $case->getCaseSubmittedChecklistByStatus('deficient'),
            'approved_cases' => $case->getCaseSubmittedChecklistByStatus('approval')
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
    public function issueDeficiency(Cases $case)
    {
        if ($case->guest->email == $case->applicant_email):
            $emails = array($case->applicant_email);
        else:
            $emails = array($case->applicant_email, $case->guest->email);
        endif;

        Mail::to($emails)->send(
            new IssueDeficiencyEmail([
                'fullname'        => $case->applicant_fullname,
                'ref_no'          => $case->reference_no,
                'case'            => $case,
                'additional_info' => request('additional_info'),
                'deficent_cases'  => $case->getCaseSubmittedChecklistByStatus('deficient')
            ])
        );
        $handler = User::find($case->active_handlers->first()->id);
        $case->issueDeficiency($handler);

        return $this->sendResponse('Deficieny sent.', 'success');
    }

    /**
     * Handles the case analysis case documents page route.
     *
     * @return void
     */
    public function analyzeCaseDocuments(Cases $case)
    {
        if (\Auth::user()->active_cases_assigned_to_all()->where('case_id', $case->id)->count() <= 0 && !in_array(\Auth::user()->account_type, ['SP']))
            return redirect()->route('cases.assigned');

        $checklistGroupDocuments = $case->getChecklistGroupDocuments();
        $title = APP_NAME;
        $description = 'FCCPC Case Documents Analysis Dashboard';
        $details = details($title, $description);

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
        $user->notify(new CaseAssigned());
        $this->sendResponse('Case assigned.', 'success', [
            'case' => $case,
            'handler' => $user,
        ]);
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
            'group' => $case->getChecklistGroupName(),
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
     * Handles the case unassign page route.
     *
     * @return void
     */
    public function unassignCase(Cases $case, User $user)
    {
        abort_if(!auth()->user(), 404);
        $result = $case->disolve($user);
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
        $newUser->notify(new CaseAssigned());
        $this->sendResponse('Case reassigned.', 'success');
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
