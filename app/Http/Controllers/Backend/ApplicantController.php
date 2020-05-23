<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Guest;

class ApplicantController extends Controller
{
	/**
	 * Handles the home page route.
     * @param int $id
	 * @return void
	 */
    public function index($id)
    { 
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

        $guest = Guest::where('email', '=', $request->email)->first();
        if ($guest) :
            return redirect()->route('applicant.index', ['id' => $guest->tracking_id]);
        else :
            $result = Guest::create([
                'email'           => trim(ucwords($request->email)),
                'tracking_id'     => generateApplicantID(),
            ]);

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
        $description      = "FCCPC Application";
        $details          = details($title, $description);
        return view('backend.applicant.submit', compact('details'));
    }
}