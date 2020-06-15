<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\ComplaintMail;
use App\Models\Guest;
use App\Models\Complaints;

class ComplaintsController extends Controller
{
    /**
     * Handles the create complaint page route.
     * @param int $id
     * @return void
     */
    public function index($id)
    {
        $title            = APP_NAME;
        $description      = "FCCPC Create Complaint Dashboard";
        $details          = details($title, $description);
        return view('backend.complaints.create-complaint', compact('details', 'id'));
    }

    /**
     * Handles the complaints log page route.
     * @return void
     */
    public function logs()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Logs Dashboard";
        $details          = details($title, $description);
        return view('backend.complaints.logs', compact('details'));
    }

    /**
     * Handles the complaints assign page route.
     *
     * @return void
     */
    public function assignCase(Request $request, $id)
    {
        Complaints::whereId($id)->update([
            'caseHandler' => $request->case_handler,
            'status'      => 1
        ]);

        return redirect()->back()->with("success", "Complaint has been assigned to case handler");
    }

    /**
     * Handles the create complaint page route.
     * @param Request $request
     * @param int $id
     * @return void
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'firstName'   => 'required',
            'lastName'    => 'required',
            'email'       => 'required',
            'phone'       => 'required',
            'message'     => 'required',
        ]);

        // Get the uploades file with name document
        $document = $request->file('file');

        // Check if uploaded file size was greater than
        // maximum allowed file size
        if ($document) {
            if ($document->getError() == 1) {
                $max_size = $document->getMaxFileSize() / 1024 / 1024;  // Get size in Mb
                Session::flash('error', "The document size must be less than {$max_size} Mb!");
                return redirect()->back();
            }
        }

        // Handle File Upload
        if($request->hasFile('file')) {
            // Get filename with extension
            $filenameWithExt = $document->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $document->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $document->storeAs('public/complaint_documents', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $result = Complaints::create([
            'tracking_id' => $id,
            'firstName'   => trim($request->firstName),
            'lastName'    => trim($request->lastName),
            'email'       => trim($request->email),
            'phone'       => trim($request->phone),
            'message'     => $request->message,
            'file'        => $fileNameToStore ?? '',
        ]);

        Mail::to(config('mail.from.address'))->send(new ComplaintMail([
            'firstName'     => $result->firstName,
            'lastName'      => $result->lastName,
            'email'         => $result->email,
            'phone'         => $result->phone,
            'message'       => $result->message,
            'document'      => $document ?? null,
        ]));

        return redirect()->back()->with('success', "Complaint submitted!");
    }

    /**
     * Handles the submit complaint page route.
     * @return void
     */
    public function submitComplaint()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Submit Complaint";
        $details          = details($title, $description);
        return view('backend.complaints.submit', compact('details'));
    }

    /**
     * Handles the authenticate submit complaint page route.
     * @param Request $request
     * @return void
     */
    public function authenticateSubmitComplaint(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
        ]);

        $result = Guest::create([
            'email'         => trim($request->email),
            'tracking_id'   => generateApplicantID(),
        ]);

        return redirect()->route('complaints.index', ['id' => $result->tracking_id]);
    }
}
