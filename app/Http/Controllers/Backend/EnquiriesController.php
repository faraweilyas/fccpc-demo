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
    public function index()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Select Enquiry Dashboard";
        $details          = details($title, $description);
        return view('backend.enquiries.select-enquiry', compact('details'));
    }

    /**
     * Handles the create enquiries page route.
     * @param string $type
     * @param int $id
     * @return void
     */
    public function create($type)
    {
        $enquiry          = formatEnquiryType($type);
        $title            = APP_NAME;
        $description      = "FCCPC ".$enquiry." Application Dashboard";
        $details          = details($title, $description);
        return view('backend.enquiries.create-enquiry', compact('details', 'type', 'enquiry'));
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
     * Handles the assigned enquiries log page route.
     * @return void
     */
    public function assignedLogs()
    {
        if (getAccountType() == 'AD'):
            $enquiries        = \App\Models\Enquiry::where('caseHandler', \Auth::user()->id)->get();
        else:
            $enquiries        = \App\Models\Enquiry::all();
        endif;

        $title            = APP_NAME;
        $description      = "FCCPC Assigned Logs Dashboard";
        $details          = details($title, $description);
        return view('backend.enquiries.assigned-logs', compact('details', 'enquiries'));
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
     * Handles the download enquiry file route.
     *
     * @return void
     */
    public function download($file)
    {
      return response()->download(storage_path("app/public/enquiry_documents/{$file}"));
    }

    /**
     * Handles the store enquiry page route.
     * @param string $type
     * @param int $id
     * @return void
     */
    public function store(Request $request, $type)
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
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $document->storeAs('public/enquiry_documents', $fileNameToStore);
        else:
            $fileNameToStore = null;
        endif;

        $enquiry = Enquiry::create([
            'firm'        => trim($request->firm ?? ''),
            'firstName'   => trim($request->firstName),
            'lastName'    => trim($request->lastName),
            'email'       => trim($request->email),
            'phone'       => trim($request->phone),
            'type'        => strtoupper($type),
            'message'     => $request->message,
            'file'        => $fileNameToStore ?? '',
        ]);

        Mail::to(config('mail.from.address'))->send(new EnquiryMail([
            'firm'          => $enquiry->firm,
            'firstName'     => $enquiry->firstName,
            'lastName'      => $enquiry->lastName,
            'email'         => $enquiry->email,
            'phone'         => $enquiry->phone,
            'type'          => $enquiry->type,
            'message'       => $enquiry->message,
            'document'      => $document ?? null,
        ]));

        return redirect()->back()->with("success", "Enquiry submitted!");
    }
}
