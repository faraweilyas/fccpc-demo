<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Mail\WelcomeApplicant;
use App\Models\Cases;
use App\Models\Guest;

class ApplicantController extends Controller
{
    /**
     * Handles the authentication page route.
     *
     * @param Request $request
     * @return void
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
        ]);

        $result             = Guest::create([
            'email'         => trim($request->email),
            'tracking_id'   => generateApplicantID(),
        ]);

        if ($result):
            Cases::create([
                'tracking_id'   => $result->tracking_id,
                'status'        => 0,
            ]);
            Mail::to($request->email)->send(new WelcomeApplicant([
                'email'         => $result->email ,
                'tracking_id'   => $result->tracking_id,
            ]));
            return redirect()->route('application.index', ['id' => $result->tracking_id]);
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
                if (is_null($case->transaction_category)):
                    return redirect()->route('application.index', ['id' => $request->tracking_id]);
                else:
                    return redirect()->route('application.create', ['type' => $case->getCaseCategory(), 'id' => $request->tracking_id]);
                endif;
            else:
                return redirect()->route('application.upload', ['id' => $request->tracking_id]);
            endif;
        else:
            Session::flash('error', "Invalid Credentials!");
            return redirect()->back();
        endif;
    }
}
