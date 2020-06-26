<?php

namespace App\Http\Controllers\Backend;

use App\Models\Guest;
use App\Models\Enquiry;
use App\Mail\EnquiryMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EnquiriesController extends Controller
{
    /**
     * Handles the select enquiry page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $title          = 'Select Enquiry Category | '.APP_NAME;
        $description    = 'Select Enquiry Category | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.enquiries.select-enquiry', compact('details'));
    }

    /**
     * Handles the create enquiry page.
     *
     * @param string $type
     * @return \Illuminate\Contracts\View\Factory
     */
    public function create(string $type)
    {
        $enquiry        = getEnquiry($type);
        $title          = "Submit {$enquiry} Enquiry | ".APP_NAME;
        $description    = "Submit {$enquiry} Enquiry | ".APP_NAME;
        $details        = details($title, $description);
        return view('backend.enquiries.create-enquiry', compact('details', 'type', 'enquiry'));
    }

    /**
     * Handles store enquiry route.
     *
     * @return void
     */
    public function store()
    {
        $validated = request()->validate([
            'type'          => ['required', 'string'],
            'firm'          => ['required', 'string'],
            'first_name'    => ['required', 'string'],
            'first_name'    => ['required', 'string'],
            'last_name'     => ['required', 'string'],
            'email'         => ['required', 'string', 'email'],
            'phone_number'  => ['required', 'string'],
            'message'       => 'required',
            'file'          => 'file',
        ]);

        if (request()->hasFile('file'))
        {
            $file               = request('file');
            $extension          = $file->getClientOriginalExtension();
            $newFileName        = \SerialNumber::randomFileName($extension);
            $path               = $file->storeAs('public/enquiry_documents', $newFileName);
            $validated['file']  = $newFileName;
        }

        $validated['type']  = strtoupper($validated['type']);
        $enquiry            = Enquiry::create($validated);
        $enquiry->document  = $file ?? null;

        try
        {
            Mail::to(config('mail.from.address'))->send(new EnquiryMail($enquiry));
        }
        catch (\Exception $exception)
        {
            $message = $exception->getMessage();
        }

        return redirect()->back()->with("success", "One of our representatives would get back to you.");
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
            $enquiries        = Enquiry::where('caseHandler', \Auth::user()->id)->get();
        else:
            $enquiries        = Enquiry::all();
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
}
