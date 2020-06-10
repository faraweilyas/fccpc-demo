<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class EnquiriesController extends Controller
{
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
        dd(true);
    }
}
