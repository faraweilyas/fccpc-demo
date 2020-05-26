<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

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
	 * @return void
	 */
    public function index($type)
    { 
        $case             = formatCaseType($type);
    	$title            = APP_NAME;
        $description      = "FCCPC Cases Log Dashboard";
    	$details          = details($title, $description);
    	return view('backend.'.getAccountType().'.cases', compact('details', 'case', 'type'));
    }

    /**
     * Handles the case review page route.
     * @return void
     */
    public function reviewCase($id)
    { 
        $case             = \App\Models\Cases::find($id);
        $title            = APP_NAME;
        $description      = "FCCPC Case Review Dashboard";
        $details          = details($title, $description);
        return view('backend.'.getAccountType().'.review-case', compact('details', 'id', 'case'));
    }

    /**
     * Handles the case assign page route.
     * @return void
     */
    public function assignCase(Request $request, $id)
    { 
        $result = \App\Models\Cases::whereId($id)->update([
                'case_handler_id' => $request->case_handler,
                'status'          => 2
         ]);

        if ($result) {
            Session::flash('success', "Transaction updated");
            return redirect()->back();
        } else {
            Session::flash('error', "Transaction not updated.");
            return redirect()->back();
        }
    }
}