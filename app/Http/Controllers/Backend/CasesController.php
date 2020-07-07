<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Cases;
use Illuminate\Http\Request;
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

        $title          = 'Unassigned Cases | '.APP_NAME;
        $description    = 'Unassigned Cases | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.cases.unassigned', compact('details', 'cases', 'caseHandlers'));
    }

    /**
     * Handles assigned cases page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function assignedCases()
    {
        $cases          = (new Cases)->assignedCases();
        $caseHandlers   = (new User)->caseHandlers();

        $title          = 'Assigned Cases | '.APP_NAME;
        $description    = 'Assigned Cases | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.cases.cases-assigned', compact('details', 'cases', 'caseHandlers'));
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
     * Handles the case review page route.
     *
     * @return void
     */
    public function reviewCase($id)
    {
        $case             = Cases::find($id);
        $title            = APP_NAME;
        $description      = "FCCPC Case Review Dashboard";
        $details          = details($title, $description);
        return view('backend.cases.review-case', compact('details', 'id', 'case'));
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
        $this->sendResponse("Case assigned.", "success");
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
