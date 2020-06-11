<?php

namespace App\Http\Controllers\Backend;

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
	 * Handles the cases display page route.
     *
	 * @return void
	 */
    public function index($type)
    {
        $cases          = Cases::where('status', 1)->get();
        $case           = formatCaseType($type);
        $title          = APP_NAME;
        $description    = "FCCPC Cases Log Dashboard";
        $details        = details($title, $description);
    	return view('backend.'.getAccountType().'.cases', compact('details', 'cases', 'case', 'type'));
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
        return view('backend.'.getAccountType().'.review-case', compact('details', 'id', 'case'));
    }

    /**
     * Handles the case assign page route.
     *
     * @return void
     */
    public function assignCase(Request $request, $id)
    {
        $result = Cases::whereId($id)->update([
            'case_handler_id' => $request->case_handler,
            'status'          => 2
        ]);

        if ($result)
            Session::flash('success', "Transaction has been assigned to case handler");
        else
            Session::flash('error', "An error occurred, please try again.");

        return redirect()->back();
    }

    /**
     * Handles the case update status page route.
     *
     * @return void
     */
    public function updateCaseStatus($status, $id)
    {
        if (Cases::whereId($id)->update(['status' => $status]))
            Session::flash('success', "Transaction status has been updated");
        else
            Session::flash('error', "An error occurred, please try again.");

        return redirect()->back();
    }
}
