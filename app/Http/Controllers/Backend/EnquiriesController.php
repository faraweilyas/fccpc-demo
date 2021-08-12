<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Guest;
use App\Models\Enquiry;
use App\Mail\NewEnquiry;
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
        return redirect()->back();

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

        // Notify enquirer
        try {
            Mail::to($enquiry->email)->send(new NewEnquiry($enquiry));
        }
        catch(\Exception $exception)
        {
            $message = $exception->getMessage();
        }

        // Notify supervisors
        $supervisors = User::where('account_type', 'SP')->where('status', 'active')->get();
        foreach($supervisors as $supervisor):
            $supervisor->notify(new CaseActionNotifier(
                'newenquiry',
                "{$fullname} has applied for a pre-notification consultation.",
                $enquiry->id,
                $enquiry
            ));
        endforeach;

        return redirect()->back()->with("success", "One of our representatives would get back to you.");
    }

    /**
     * Handles enquiries log page route.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function logs()
    {
        $caseHandlers   = User::where('status', 'active')->where('account_type', 'CH')->get();
        $enquiries      = Enquiry::getEnquiries(auth()->user());
        $title          = APP_NAME;
        $description    = "FCCPC Logs Dashboard";
        $details        = details($title, $description);
        return view('backend.enquiries.logs', compact('details', 'enquiries', 'caseHandlers'));
    }

    /**
     * Handles enquiry assign page route.
     *
     * @return object
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
            'assignenquiry',
            "Pre-notification has been assigned to {$handler->getFullName()}.",
            $enquiry->id
        ));

        $handler->notify(new CaseActionNotifier(
            'assignenquiry',
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
        if (file_exists($file = storage_path("app/public/enquiry_documents/{$file}")))
            return response()->file($file);

        return back();
    }
}
