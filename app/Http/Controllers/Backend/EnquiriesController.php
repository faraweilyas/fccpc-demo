<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\EnquiryMail;
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
     * Handles the create enquiries page route.
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
     * Handles the enquiries log page route.
     * @return void
     */
    public function logs()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Logs Dashboard";
        $details          = details($title, $description);
        return view('backend.enquiries.logs', compact('details'));
    }

    /**
     * Handles the enquiry assign page route.
     *
     * @return void
     */
    public function assignLog(Request $request, $id)
    {
        Enquiry::whereId($id)->update([
            'caseHandler' => $request->case_handler,
            'status'      => 1
        ]);

        return redirect()->back()->with("success", "Enquiry has been assigned to case handler");
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

        // Get the uploades file with name document
        $document = $request->file('file');

        // Check if uploaded file size was greater than
        // maximum allowed file size
        if ($document):
            if ($document->getError() == 1):
                $max_size = $document->getMaxFileSize() / 1024 / 1024;  // Get size in Mb
                Session::flash('error', "The document size must be less than {$max_size} Mb!");
                return redirect()->back()->with("error", "The document size must be less than {$max_size} Mb!");
            endif;
        endif;

        // Handle File Upload
        if ($request->hasFile('file')):
            // Get filename with extension
            $filenameWithExt = $document->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $document->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $document->storeAs('public/enquiry_documents', $fileNameToStore);
        else:
            $fileNameToStore = 'noimage.jpg';
        endif;

        $result = Enquiry::create([
            'tracking_id' => $id,
            'firm'        => trim($request->firm),
            'firstName'   => trim($request->firstName),
            'lastName'    => trim($request->lastName),
            'email'       => trim($request->email),
            'phone'       => trim($request->phone),
            'type'        => strtoupper($type),
            'message'     => $request->message,
            'file'        => $fileNameToStore ?? '',
        ]);

        Mail::to(config('mail.from.address'))->send(new EnquiryMail([
            'firm'          => $result->firm,
            'firstName'     => $result->firstName,
            'lastName'      => $result->lastName,
            'email'         => $result->email,
            'phone'         => $result->phone,
            'type'          => $result->type,
            'message'       => $result->message,
            'document'      => $document ?? null,
        ]));

        return redirect()->back()->with("success", "Enquiry submitted!");
    }

    /**
     * Handles the submit enquiry page route.
     * @return void
     */
    public function submitEnquiry()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Track Enquiry";
        $details          = details($title, $description);
        return view('backend.enquiries.submit', compact('details'));
    }

    /**
     * Handles the authenticate submit enquiry page route.
     * @return void
     */
    public function authenticateSubmitEnquiry(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
        ]);

        $result             = Guest::create([
            'email'         => trim($request->email),
            'tracking_id'   => generateApplicantID(),
        ]);

        return redirect()->route('enquiries.index', ['id' => $result->tracking_id]);
    }
}
