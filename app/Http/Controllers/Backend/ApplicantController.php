<?php

namespace App\Http\Controllers\Backend;

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
     * @param Guest $guest
     * @return \Illuminate\Contracts\View\Factory
     */
    public function authenticateTrack(Guest $guest)
    {
        request()->validate([
            'tracking_id' => ['required', 'exists:guests,tracking_id'],
        ]);

        $guest = Guest::where('tracking_id', '=', request('tracking_id'))->firstOrFail();

        // Check if case has been submitted
        if ($guest->case->isSubmitted())
            return redirect($guest->uploadDocumentsPath());

        return (!$guest->case->isCategorySet())
                ? redirect($guest->applicationPath())
                : redirect($guest->createApplicationPath($guest->case->case_category));
    }
}
