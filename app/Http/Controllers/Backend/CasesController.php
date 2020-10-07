<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Cases;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Notifications\CaseAssigned;
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
     * Handles unassigned cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function unassignedCases()
    {
        $cases          = (new Cases)->unassignedCases();
    
        $caseHandlers   = (new User)->caseHandlers();

        $title          = 'New Cases | '.APP_NAME;
        $description    = 'New Cases | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.cases.unassigned', compact('details', 'cases', 'caseHandlers'));
    }

    /**
     * Handles assigned cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function assignedCases(User $handler)
    {
        if(isset($handler->status)):
            $cases          = $handler->active_cases_assigned_to()->get();
        else:
            if (auth()->user()->account_type == 'CH'):
                $cases          = auth()->user()->active_cases_assigned_to()->get();
            else:
                $cases          = (new Cases)->assignedCases();
            endif;
        endif; 
        
        $caseHandlers   = (new User)->caseHandlers();

        $title          = 'Assigned Cases | '.APP_NAME;
        $description    = 'Assigned Cases | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.cases.cases-assigned', compact('details', 'cases', 'caseHandlers'));
    }

    /**
     * Handles dropped cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function droppedCases(User $handler)
    {
        $cases          = $handler->dropped_cases_assigned_to()->get();
        $caseHandlers   = (new User)->caseHandlers();

        $title          = 'Dropped Cases | '.APP_NAME;
        $description    = 'Dropped Cases | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.cases.cases-dropped', compact('details', 'cases', 'caseHandlers'));
    } 

    /**
     * Handles approved cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function approvedCases()
    {
        $cases          = (new Cases)->assignedCases();
        $caseHandlers   = (new User)->caseHandlers();

        $title          = 'Approved Cases | '.APP_NAME;
        $description    = 'Approved Cases | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.cases.cases-approved', compact('details', 'cases', 'caseHandlers'));
    }

    /**
     * Handles archived cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function archivedCases()
    {
        $cases          = (new Cases)->archivedCases();
        $caseHandlers   = (new User)->caseHandlers();

        $title          = 'Archived Cases | '.APP_NAME;
        $description    = 'Archived Cases | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.cases.cases-archived', compact('details', 'cases', 'caseHandlers'));
    }

    /**
     * Handles the case analysis page route.
     *
     * @return void
     */
    public function analyzeCase(Cases $case)
    {
        $title            = APP_NAME;
        $description      = "FCCPC Case Analysis Dashboard";
        $details          = details($title, $description);
        return view('backend.cases.analyze-case', compact('details', 'case'));
    }

    /*
     * Handles the checklist approval page route.
     *
     * @return void
     */
    public function checklistApproval(Cases $case)
    {
        $title            = APP_NAME;
        $description      = "FCCPC Checklist Approval Dashboard";
        $details          = details($title, $description);
        return view('backend.cases.checklist-approval', compact('details', 'case'));
    }

    /**
     * Handles the case analysis case documents page route.
     *
     * @return void
     */
    public function analyzeCaseDocuments(Cases $case)
    {
        $title            = APP_NAME;
        $description      = "FCCPC Case Documents Analysis Dashboard";
        $details          = details($title, $description);
        return view('backend.cases.analyze-case-documents', compact('details', 'case'));
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
        $user->notify(
            new CaseAssigned()
        );  
        $this->sendResponse("Case assigned.", "success", [
            'case'      => $case,
            'handler'   => $user
        ]);
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

        $this->sendResponse("Case checklists received.", "success", [
            'checklists'   => $checklists,
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

        $this->sendResponse("Case documents received.", "success", [
            'documents'   => $documents,
            'group'       => $case->getChecklistGroupName(),
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

        $this->sendResponse("Document Icon received.", "success", [
            'icon'   => $document->getIconText(),
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
        $this->sendResponse("Case unassigned.", "error");
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
        $newUser->notify(
            new CaseAssigned()
        );  
        $this->sendResponse("Case reassigned.", "success");
    }

    /**
     * Handles the case update status page route.
     *
     * @return void
     */
    public function updateCaseStatus($status, $id)
    {
        Cases::whereId($id)->update([
            'status' => $status
        ]);

        return redirect()->back()->with("success", "Transaction status has been updated");
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
}
