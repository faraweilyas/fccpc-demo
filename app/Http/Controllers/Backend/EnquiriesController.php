<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Guest;

class EnquiriesController extends Controller
{
    /**
     * Handles the select application page route.
     * @param int $id
     * @return void
     */
    public function index($id)
    {
        // if (!Guest::where('tracking_id', '=', $id)->first()) {
        //     Session::flash('error', "Invalid Credential");
        //     return redirect()->route('applicant.submit');
        // }

        // if ($case = Cases::where('tracking_id', '=', $id)->first()):
        //     if ($case->status > 0):
        //         return redirect()->route('application.success', ['id' => $id]);
        //     endif;
        // endif;

        $title            = APP_NAME;
        $description      = "FCCPC Select Enquiry Dashboard";
        $details          = details($title, $description);
        return view('backend.enquiries.select-enquiry', compact('details', 'id'));
    }

    /**
     * Handles the track enquiry page route.
     * @return void
     */
    public function trackEnquiry()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Track Enquiry";
        $details          = details($title, $description);
        return view('backend.enquiries.track', compact('details'));
    }

    /**
     * Handles the authenticate track enquiry page route.
     * @return void
     */
    public function authenticateTrackEnquiry(Request $request)
    {
        $this->validate($request, [
            'tracking_id' => ['required'],
        ]);

        $result             = Guest::where('tracking_id', $request->tracking_id)->first();

        if ($result):
            return redirect()->route('enquiries.index', ['id' => $result->tracking_id]);
        else:
            Session::flash('error', "Invalid Credential!");
            return redirect()->back();
        endif;
    }
}
