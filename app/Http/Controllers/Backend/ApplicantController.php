<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cases;
use App\Models\Guest;
use Illuminate\Http\Request;
use App\Mail\WelcomeApplicant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ApplicantController extends Controller
{
    /**
     * Handles submit application page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function show()
    {
        $title          = 'Submit Application | '.APP_NAME;
        $description    = 'Submit Application | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.applicant.show', compact('details'));
    }

    /**
     * Handles authentication page.
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        request()->validate([
            'email' => ['required', 'email'],
        ]);

        $guest = Guest::create([
            'ip_address'    => request()->ip(),
            'email'         => trim(request('email')),
            'tracking_id'   => \SerialNumber::trackingId(),
        ]);

        $case = $guest->startCase();

        try
        {
            Mail::to(request('email'))->send(new WelcomeApplicant($guest, $case));
            $message = 'Mail notification sent!';
        }
        catch (\Exception $exception)
        {
            $message = $exception->getMessage();
        }

        return redirect($guest->applicationPath());
    }

    /**
     * Handles track application page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function trackApplication()
    {
        $title          = 'Track Application | '.APP_NAME;
        $description    = 'Track Application | '.APP_NAME;
        $details        = details($title, $description);
        return view('backend.applicant.track', compact('details'));
    }

    /**
     * Handles authenticate track application page.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory
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
                return redirect()->route('application.submitted', ['id' => $request->tracking_id]);
            endif;
        else:
            return redirect()->back()->with("error", "Invalid Credentials!");
        endif;
    }
}
