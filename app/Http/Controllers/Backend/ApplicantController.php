<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeApplicant;
use Illuminate\Support\Facades\Session;
use App\Models\Guest;
use App\Models\Cases;

class ApplicantController extends Controller
{
	/**
	 * Handles the home page route.
     * @param int $id
	 * @return void
	 */
    public function index($id)
    { 
        if (!Guest::where('tracking_id', '=', $id)->first()) {
            Session::flash('error', "Invalid Credential");
            return redirect()->route('applicant.submit');
        }

        $case             = Cases::where('tracking_id', '=', $id)->first();
        if ($case->status > 0):
            return redirect()->route('application.success', ['id' => $id]);
        endif;

    	$title            = APP_NAME;
        $description      = "FCCPC dashboard";
    	$details          = details($title, $description);
    	return view('backend.applicant.index', compact('details','id'));
    }

    /**
     * Handles the authentication page route.
     * @param Request $request
     * @return void
     */
    public function authenticate(Request $request)
    { 
        $this->validate($request, [
            'email'       => 'required',
        ]);

        $result = Guest::create([
            'email'           => trim(ucwords($request->email)),
            'tracking_id'     => generateApplicantID(),
        ]);

        $data = array(
            'email'       => $result->email ,
            'tracking_id' => $result->tracking_id
        );
        if ($result):
            // Mail::to($request->email)->send(new WelcomeApplicant($data));
            return redirect()->route('applicant.index', ['id' => $result->tracking_id]);
        endif;
    }

    /**
     * Handles the submit application page route.
     * @return void
     */
    public function submitApplication()
    { 
        $title            = APP_NAME;
        $description      = "FCCPC Submit Application";
        $details          = details($title, $description);
        return view('backend.applicant.submit', compact('details'));
    }

    /**
     * Handles the track application page route.
     * @return void
     */
    public function trackApplication()
    { 
        $title            = APP_NAME;
        $description      = "FCCPC Track Application";
        $details          = details($title, $description);
        return view('backend.applicant.track', compact('details'));
    }

    /**
     * Handles the authenticate track application page route.
     * @return void
     */
    public function authenticateTrack(Request $request)
    { 
        $this->validate($request, [
            'tracking_id'       => 'required',
        ]);

        $guest = Guest::where('tracking_id', '=', $request->tracking_id)->first();
        $case  = Cases::where('tracking_id', '=', $request->tracking_id)->first();
        if ($guest):
            if ($case->status <= 0):
                return redirect()->route('application.create', ['type' => strtolower(\App\Enhancers\AppHelper::$case_categories[$case->transaction_category]), 'id' => $request->tracking_id]);
            else:
                return redirect()->route('application.upload', ['id' => $request->tracking_id]);
            endif;
            
        else:
            Session::flash('error', "Invalid Credentials!");
            return redirect()->back();
        endif;
    }
}