<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\Enquiry;

class EnquiriesController extends Controller
{
    /**
     * Handles the select application page route.
     * @param int $id
     * @return void
     */
    public function index($id)
    {
        $title            = APP_NAME;
        $description      = "FCCPC Select Enquiry Dashboard";
        $details          = details($title, $description);
        return view('backend.enquiries.select-enquiry', compact('details', 'id'));
    }

    /**
     * Handles the create application page route.
     * @param string $type
     * @param int $id
     * @return void
     */
    public function create($type, $id)
    {
        $enquiry          = formatEnquiryType($type);
        $title            = APP_NAME;
        $description      = "FCCPC ".$enquiry." Application Dashboard";
        $details          = details($title, $description);
        return view('backend.enquiries.create-enquiry', compact('details', 'id', 'type', 'enquiry'));
    }

    /**
     * Handles the create application page route.
     * @param string $type
     * @param int $id
     * @return void
     */
    public function store(Request $request, $type, $id)
    {
        $this->validate($request, [
            'firm'        => 'required',
            'firstName'   => 'required',
            'lastName'    => 'required',
            'email'       => 'required',
            'phone'       => 'required',
            'message'     => 'required',
        ]);

        $result = Enquiry::create([
            'tracking_id' => $id,
            'firm'        => trim($request->firm),
            'firstName'   => trim($request->firstName),
            'lastName'    => trim($request->lastName),
            'email'       => trim($request->email),
            'phone'       => trim($request->phone),
            'type'        => strtoupper($type),
            'message'     => $request->message,
        ]);

        if ($result):
            Session::flash('success', "Enquiry submitted!");
            return redirect()->back();
        else:
            Session::flash('error', "Enquiry not submitted!");
            return redirect()->back();
        endif;
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
            'tracking_id' => 'required',
        ]);

        $result = Guest::where('tracking_id', $request->tracking_id)->first();

        if ($result):
            return redirect()->route('enquiries.index', ['id' => $result->tracking_id]);
        else:
            Session::flash('error', "Invalid Credential!");
            return redirect()->back();
        endif;
    }
}
