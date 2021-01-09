<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Guest;
use App\Models\Enquiry;
use App\Mail\EnquiryMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Notifications\CaseActionNotifier;

class EnquiriesController extends Controller
{
    /**
     * Handles select enquiry page.
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
     * Handles create enquiry page.
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
        $supervisors = User::where('account_type', 'SP')->where('status', 'active')->get();

        $validated = request()->validate([
            'type'          => ['required', 'string'],
            'firm'          => ['required', 'string'],
            'subject'       => ['required', 'string'],
            'first_name'    => ['required', 'string'],
            'last_name'     => ['required', 'string'],
            'email'         => ['required', 'string', 'email'],
            'phone_number'  => ['required', 'string'],
            'message'       => 'required',
            'file'          => 'file',
        ]);

        $fullname = request('first_name').' '.request('last_name');
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

        foreach ($supervisors as $supervisor):
             // Notify supervisor
            $supervisor->notify(new CaseActionNotifier(
                'newenquiry',
                "{$fullname} has created a new pre-notification.",
                $enquiry->id
            ));
        endforeach;

        return redirect()->back()->with("success", "One of our representatives would get back to you.");
    }

    /**
     * Handles enquiries log page route.
     *
     * @return void
     */
    public function logs()
    {
        $caseHandlers     = User::where('status', 'active')->where('account_type', 'CH')->get();
        if (auth()->user()->account_type == 'CH'):
            $enquiries        = Enquiry::where('handler_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        else:
            $enquiries        = Enquiry::orderBy('id', 'DESC')->get();
        endif;

        $title            = APP_NAME;
        $description      = "FCCPC Logs Dashboard";
        $details          = details($title, $description);
        return view('backend.enquiries.logs', compact('details', 'enquiries', 'caseHandlers'));
    }

    /**
     * Handles enquiry assign page route.
     *
     * @return void
     */
    public function assignLog()
    {
        $handler_id = request('case_handler');
        $enquiry_id = request('enquiry_id');
        $enquiry    = Enquiry::find($enquiry_id);
        $handler    = User::find($handler_id);
        $supervisor = auth()->user();

        Enquiry::whereId($enquiry_id)->update([
            'handler_id'  => $handler_id,
            'status'      => 'assigned'
        ]);

        $supervisor->notify(new CaseActionNotifier(
                'newenquiry',
                "Pre-notification has been assigned to {$handler->getFullName()}.",
                $enquiry->id
            ));

        $handler->notify(new CaseActionNotifier(
                'newenquiry',
                "{$supervisor->getFullName()} has assigned a pre-notification to you.",
                $enquiry->id
            ));

        return redirect()->back()->with("success", "Enquiry has been assigned to case handler");
    }

    /**
     * Handles download enquiry file route.
     *
     * @return void
     */
    public function download($file)
    {
      return response()->download(storage_path("app/public/enquiry_documents/{$file}"));
    }
}
