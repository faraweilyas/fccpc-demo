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
     * Handles the create complaint page route.
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

        if ($result):
            Mail::to("kamsikodi@gmail.com")->send(new ComplaintMail([
                'firstName'     => $result->firstName,
                'lastName'      => $result->lastName,
                'email'         => $result->email,
                'phone'         => $result->phone,
                'message'       => $result->message,
                'document'      => $document ?? null,
            ]));
            Session::flash('success', "Complaint submitted!");
            return redirect()->back();
        else:
            Session::flash('error', "Complaint not submitted!");
            return redirect()->back();
        endif;
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
