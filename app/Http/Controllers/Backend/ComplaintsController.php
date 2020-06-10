<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\Guest;

class ComplaintsController extends Controller
{
    /**
     * Handles the create complaint page route.
     * @param int $id
     * @return void
     */
    public function index($id)
    {
        // $title            = APP_NAME;
        // $description      = "FCCPC Create Complaint Dashboard";
        // $details          = details($title, $description);
        // return view('backend.complaints.create-complaint', compact('details', 'id'));
    }

    /**
     * Handles the track complaint page route.
     * @return void
     */
    public function trackComplaint()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Track Complaint";
        $details          = details($title, $description);
        return view('backend.complaints.track', compact('details'));
    }

    /**
     * Handles the authenticate track complaint page route.
     * @return void
     */
    public function authenticateTrackComplaint(Request $request)
    {
        $this->validate($request, [
            'tracking_id' => 'required',
        ]);

        $result = Guest::where('tracking_id', $request->tracking_id)->first();

        if ($result):
            return redirect()->route('complaints.index', ['id' => $result->tracking_id]);
        else:
            Session::flash('error', "Invalid Credential!");
            return redirect()->back();
        endif;
    }
}
