<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Guest;
use App\Models\Document;
use App\Models\RequestID;
use Illuminate\Http\Request;
use App\Mail\WelcomeApplicant;
use App\Notifications\IDRequest;
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
        $title          = 'File/Submit Notification | ' . APP_NAME;
        $description    = 'File/Submit Notification | ' . APP_NAME;
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
        $title          = 'Confirm Notification ID | ' . APP_NAME;
        $description    = 'Confirm Notification ID | ' . APP_NAME;
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
     * Handles recovery of application ID page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function recoverID()
    {
        $title          = 'Recover Notification ID | ' . APP_NAME;
        $description    = 'Recover Notification ID | ' . APP_NAME;
        $details        = details($title, $description);
        return view('backend.applicant.recover-id', compact('details'));
    }

    /**
     * Handles recovery of application ID request.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function recoverIDRequest()
    {
        request()->validate([
            'email'    => ['required', 'email'],
            'access'   => 'required',
            'category' => 'required',
            'subject'  => 'required',
            'type'     => 'required',
        ]);

        $handlers   = (new User)->caseHandlers();
        $parties    = is_array(request('party')) ? request('party') : [];

        $request = RequestID::create([
            'email'           => request('email'),
            'email_access'    => request('access'),
            'category'        => request('category'),
            'subject'         => request('subject'),
            'parties'         => implode(':', $parties),
            'type'            => request('type'),
        ]);

        foreach ($handlers as $handler):
            // Notify case handler
            $handler->notify(new IDRequest(
                "newidrequest",
                'New Notification ID Request.',
                $request->id
            ));
        endforeach;

        return redirect()->route('applicant.recover_id_success')->with('success', 'Your request has been sent!');
    }

    /**
     * Handles recovery of application ID success page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function viewRecoverIDSuccess()
    {
        $title          = 'Recover Notification ID | ' . APP_NAME;
        $description    = 'Recover Notification ID | ' . APP_NAME;
        $details        = details($title, $description);
        return view('backend.applicant.recover-id-success', compact('details'));
    }

    /**
     * Handles resending of confirmation email.
     *
     * @param string $email
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function resendEmail($email)
    {
        $guest = Guest::create([
            'ip_address' => request()->ip(),
            'email' => $email,
            'tracking_id' => \SerialNumber::trackingId(),
        ]);

        $case = $guest->startCase();

        try {
            Mail::to($email)->send(
                new WelcomeApplicant($guest, $case)
            );
            $message = 'Mail notification sent!';
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
        }

        return redirect()->back()->with('success', 'Email has been sent!');
    }

    /**
     * Handles track application page.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function trackApplication()
    {
        $title          = 'Manage Notification | ' . APP_NAME;
        $description    = 'Manage Notification | ' . APP_NAME;
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
     * @param Document $document
     * @param string $file
     * @return \Illuminate\Contracts\View\Factory
     */
    public function downloadDocument(Document $document, $file)
    {
        $groupName = \Str::slug($document->group->name);
        $extension = pathinfo($file)['extension'];
        $doc      = storage_path("app/public/documents/{$file}");

        if (!is_file($doc) && !file_exists($doc))
            return redirect()->back()->with('error', 'File was not found!');

        return response()->file($doc);
    }

    /**
     * Handles download document page for letter of appointment.
     *
     * @param string $document
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
     * @param string $document
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
