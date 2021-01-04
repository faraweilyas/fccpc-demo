<?php

namespace App\Http\Controllers\Backend;

use App\Models\Guest;
use App\Models\Document;
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
        $title          = 'Submit Application | ' . APP_NAME;
        $description    = 'Submit Application | ' . APP_NAME;
        $details        = details($title, $description);
        return view('backend.applicant.show', compact('details'));
    }

    /**
     * Handles confirm tracking id page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function confirm($email)
    {
        $title          = 'Confirm Tracking ID | ' . APP_NAME;
        $description    = 'Confirm Tracking ID | ' . APP_NAME;
        $details        = details($title, $description);
        return view('backend.applicant.confirm', compact('details', 'email'));
    }

    /**
     * Handles submit confirm tracking id page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function confirmSubmit()
    {
        request()->validate([
            'application_id' => 'required',
        ]);

        $guest = Guest::where('tracking_id', request('application_id'))->first();

        if (!$guest) {
            return redirect()
                ->back()
                ->with('error', 'Invalid application ID!');
        }

        return redirect($guest->applicationPath());
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
            'ip_address' => request()->ip(),
            'email' => trim(request('email')),
            'tracking_id' => \SerialNumber::trackingId(),
        ]);

        $case = $guest->startCase();

        try {
            Mail::to(request('email'))->send(
                new WelcomeApplicant($guest, $case)
            );
            $message = 'Mail notification sent!';
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        }

        return redirect()->route('applicant.confirm', [
            'email' => request('email'),
        ]);
    }

    /**
     * Handles track application page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function trackApplication()
    {
        $title          = 'Manage Application | ' . APP_NAME;
        $description    = 'Manage Application | ' . APP_NAME;
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

        $guest = Guest::where(
            'tracking_id',
            '=',
            request('tracking_id')
        )->firstOrFail();

        if (is_null($guest->case))
            return redirect()->back()->with('error', 'Invalid Application ID');

        // Check if case has been submitted
        if ($guest->case->isSubmitted()) {
            return redirect($guest->uploadDocumentsPath());
        }

        return !$guest->case->isCategorySet()
            ? redirect($guest->applicationPath())
            : redirect(
                $guest->createApplicationPath($guest->case->case_category)
            );
    }

    /**
     * Handles download document page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function downloadDocument(Document $document, $file)
    {
        $groupName = \Str::slug($document->group->name);
        $extension = pathinfo($file)['extension'];
        $doc      = storage_path("app/public/documents/{$file}");

        if (!is_file($doc) && !file_exists($doc))
            return redirect()->back()->with('error', 'File was not found!');

        return response()->download(
            $doc,
            "{$groupName}.{$extension}"
        );
    }

    /**
     * Handles download document page for letter of appointment.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function letterOfAppointmenDownload($document)
    {
        $groupName = \Str::slug($document);
        $extension = pathinfo($document)['extension'];
        $file      = storage_path("app/public/documents/{$document}");

        if (!is_file($file) && !file_exists($file))
            return redirect()->back()->with('error', 'File was not found!');

        return response()->download(
            $file,
            "{$groupName}.{$extension}"
        );
    }

    /**
     * Handles download document page for form document.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function downloadFormDocument($document)
    {
        $groupName = \Str::slug($document);
        $extension = pathinfo($document)['extension'];
        $file      = storage_path("app/public/application_forms/{$document}");

        if (!is_file($file) && !file_exists($file))
            return redirect()->back()->with('error', 'File was not found!');

        return response()->download(
            $file,
            "{$groupName}.{$extension}"
        );
    }
}
