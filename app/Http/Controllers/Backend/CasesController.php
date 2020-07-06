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
	 * Handles the cases display page route.
     *
	 * @return void
	 */
    public function index($type)
    {
        $case           = formatCaseType($type);
        $title          = APP_NAME;
        $description    = "FCCPC Cases Log Dashboard";
        $details        = details($title, $description);
    	return view('backend.cases.cases-'.$type, compact('details', 'case', 'type'));
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
    public function assignCase(Request $request, $id)
    {
        Cases::whereId($id)->update([
            'case_handler_id' => $request->case_handler,
            'status'          => 2
        ]);

        return redirect()->back()->with("success", "Transaction has been assigned to case handler");
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
}
