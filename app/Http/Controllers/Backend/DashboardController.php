<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Models\User;
use App\Models\Cases;
use App\Models\RequestID;
use Illuminate\Http\Request;
use App\Notifications\NewUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\SendRequestedID;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Handles the admin home page route.
	 * @return \Illuminate\Contracts\View\Factory
	 */
    public function index()
    {
        if (!auth()->user()->changed_password)
            return redirect()->route('dashboard.update_password');

        if (in_array(\Auth::user()->account_type, ['SP'])):
            $new_cases = (new Cases())->unassignedCases()->take(5);
        else:
            $new_cases = auth()
                ->user()
                ->active_cases_assigned()
                ->get()->take(5);
        endif;
        $cases            = new Cases();
    	$title            = APP_NAME;
        $description      = "FCCPC Dashboard";
    	$details          = details($title, $description);
    	return view('backend.admin.index', compact('details', 'cases', 'new_cases'));
    }

    /**
     * Handles the update user password page route.
     * @return \Illuminate\Contracts\View\Factory
     */
    public function updatePassword()
    {
        if (auth()->user()->changed_password)
            return redirect()->route('dashboard.index');

        $title            = APP_NAME;
        $description      = "FCCPC Update Password";
        $details          = details($title, $description);
        return view('backend.admin.update-password', compact('details'));
    }

    /**
     * Handles the store update user password page route.
     * @return \Illuminate\Contracts\View\Factory
     */
    public function storeUpdatePassword()
    {
        request()->validate([
            'password'  => ['required', 'string', 'confirmed'],
        ]);

        $data = auth()->user()->update([
            'password'         => Hash::make(request('password')),
            'changed_password' => 1
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Password updated!');
    }

    /**
     * Handles the create user page route.
     * @return \Illuminate\Contracts\View\Factory
     */
    public function createUser()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Dashboard Create User";
        $details          = details($title, $description);
        return view('backend.admin.create-user', compact('details'));
    }

    /**
     * Handles the store user page route.
     * @return \Illuminate\Contracts\View\Factory
     */
    public function storeUser(Request $request)
    {
        $this->validate($request, [
            'firstName'       => ['required', 'string', 'max:255'],
            'lastName'        => ['required', 'string', 'max:255'],
            'email'           => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'accountType'     => 'required',
        ]);

        $user = User::create([
            'first_name'    => trim(ucfirst($request->firstName)),
            'last_name'     => trim(ucfirst($request->lastName)),
            'email'         => $request->email,
            'password'      => Hash::make(config('app.default_password')),
            'account_type'  => $request->accountType,
        ]);

        // Notify new user
        $user->notify(new NewUser(
            "newuser",
            "Hi {$user->getFirstName()}, Welcome to FCCPC - Mergers & Acquisition Platform.",
            $user,
            config('app.default_password')
        ));
        return redirect()->back()->with("success", "User created sucessfully");
    }

    /**
     * Handles the view users page route.
     * @return \Illuminate\Contracts\View\Factory
     */
    public function viewUsers()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Dashboard View Users";
        $details          = details($title, $description);
        return view('backend.admin.view-users', compact('details'));
    }

    /**
     * Handles the view profile page route.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function viewProfileUpdate()
    {
        $user           = Auth::user();
        $title          = "Update Profile - ".APP_NAME;
        $description    = "Update Profile - ".APP_NAME;
        $details        = details($title, $description);
        return view('backend.user.update-profile', compact('details', 'user'));
    }

    /**
     * Handles the view application id requests page route.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function viewIDRequests()
    {
        $requests       = RequestID::where('status', 0)->latest()->get();
        $title          = "ID Requests - ".APP_NAME;
        $description    = "ID Requests - ".APP_NAME;
        $details        = details($title, $description);
        return view('backend.admin.id-requests', compact('details', 'requests'));
    }

    /**
     * Handles the view application id suggested cases page route.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory
     */
    public function viewSuggestedCases($id)
    {
        $cases          = (new Cases)->getSuggestedCases($id);
        $caseHandlers   = (new User())->caseHandlers();
        $supervisors    = (new User())->supervisors();

        $title          = "Suggested Cases - ".APP_NAME;
        $description    = "Suggested Cases - ".APP_NAME;
        $details        = details($title, $description);
        return view('backend.admin.suggested-cases', compact('details', 'cases', 'id', 'caseHandlers', 'supervisors'));
    }

    /**
     * Handles the send application id page route.
     *
     * @param Cases $case
     * @param int $request_id
     * @return \Illuminate\Contracts\View\Factory
     */
    public function sendCaseID(Cases $case, $request_id)
    {
        (new User)->forceFill([
            'email' => $case->guest->email,
        ])->notify(new SendRequestedID($case->guest->tracking_id));

        $requests   = RequestID::whereId($request_id)->update([
                            'status'  => 1
                         ]);

        return redirect()->route('dashboard.id_requests')->with('success', 'Application ID Sent!');
    }

    /**
     * Handles the view user detail page route.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory
     */
    public function viewProfile(User $user = null)
    {
        $user           = (!$user) ? auth()->user() : $user;
        $title          = "Profile - ".APP_NAME;
        $description    = "Profile - ".APP_NAME;
        $details        = details($title, $description);
        return view('backend.admin.profile', compact('details', 'user'));
    }

    /**
     * Handles the update user status page route.
     *
     * @param int $user
     * @return \Illuminate\Contracts\View\Factory
     */
    public function updateUserStatus($id)
    {
        $check_status = User::findOrFail($id);

        User::whereId($id)->update([
            'status' => ($check_status->status == 'active') ? 'inactive' : 'active'
        ]);

        return redirect()->back()->with("success", "User's status updated");
    }

    /**
     * Handles the update profile page route.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory
     */
    public function updateProfile(Request $request)
    {
        if (isset($request->password)) {
            if (Hash::check($request->password, Auth::user()->password)) {
                if ($request->new_password === $request->password_confirmation) {
                    User::whereId(Auth::user()->id)->update([
                            'password'  => Hash::make($request->new_password)
                     ]);

                    return redirect()->back()->with("success", "Profile updated");
                } else {
                    return redirect()->back()->with("error", "Password Mismatch");
                }
            } else {
                return redirect()->back()->with("error", "Invalid Password");
            }
        }

        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'     => 'required'
        ]);

        User::whereId(Auth::user()->id)->update([
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'phone_number'  => $request->phone_number ?? '',
            'address'       => $request->address  ?? ''
        ]);
        return redirect()->back()->with("success", "Profile updated");
    }

    /**
     * Handles the mark notifications as read route.
     * @return bool
     */
    public function markNotifications()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return true;
    }

    /**
     * Handles the clear read notification as read route.
     * @return void
     */
    public function clearReadNotification()
    {
        auth()->user()->readNotifications()->delete();
        return true;
    }

    /**
     * Handles the generate report page route.
     * @return void
     */
    public function generateReport()
    {
        $caseHandlers     = (new User())->caseHandlers();
        $title            = APP_NAME;
        $description      = "FCCPC Dashboard Generate Report";
        $details          = details($title, $description);
        return view('backend.admin.generate-report', compact('details', 'caseHandlers'));
    }

    /**
     * Handles the get generated amount paid report page route.
     *
     * @param string $category
     * @return void
     */
    public function getGeneratedAmountPaidReport($category)
    {
        $small_case_array = [];
        $large_case_array = [];

        for ($index = 1; $index <= 12; $index++):
            $small_case_array[$index] = (new Cases)->getTotalAmountByMonthAndCategory($index, $category, 'SM');
            $large_case_array[$index] = (new Cases)->getTotalAmountByMonthAndCategory($index, $category, 'LG');
        endfor;

        return $this->sendResponse('Cases resolved.', 'success', [
            'small' => $small_case_array,
            'large' => $large_case_array
        ]);
    }

    /**
     * Handles the generate report table page route.
     *
     * @param string $show
     * @return \Illuminate\Contracts\View\Factory
     */
    public function generateReportTable($show)
    {
        $date_array    = explode(' to ', request('start_date_end_date'));
        $start_date    = trim($date_array[0] ?? "");
        $end_date      = trim($date_array[1] ?? $start_date);

        if (empty($end_date))
            return redirect()->back()->with('error', 'Invalid date range selected');

        $start_ate     = $start_date.' 00:00:00';
        $end_date      = $end_date.' 23:59:59';
        $handler_id    = request('handler_id');
        $category      = request('category');
        $type          = request('type');
        $custom_filter = request('custom-filter-check');

        $cases       = (new Cases)->submittedCases();
        if (is_null($handler_id)):
            if (isset($custom_filter)):
                $cases   = (new Cases)->getCaseByDateRangeTypeAndCategory($start_date, $end_date, $category, $type);
            else:
                $cases   = (new Cases)->getCaseByDateRange($start_date, $end_date);
            endif;
        else:
            if (isset($custom_filter)):
                $cases   = (new Cases)->getCaseByDateRangeTypeCategoryAndHandler($start_date, $end_date, $handler_id, $category, $type);
            else:
                $cases   = (new Cases)->getCaseByDateRangeAndHandler($start_date, $end_date, $handler_id);
            endif;
        endif;

        $caseHandlers = (new User())->caseHandlers();

        $title            = APP_NAME;
        $description      = "FCCPC Dashboard Generate Report";
        $details          = details($title, $description);
        return view('backend.admin.generate-report', compact('details', 'cases', 'caseHandlers', 'show'));
    }

    /**
     * Handles the export report to csv page route.
     *
     * @return CSV
     */
    public function exportReportCSV()
    {
        $date_array    = explode(' to ', request('start_date_end_date'));
        $start_date    = trim($date_array[0] ?? "");
        $end_date      = trim($date_array[1] ?? $start_date);

        if (empty($end_date))
            return redirect()->back()->with('error', 'Invalid date range selected');

        $start_date     = $start_date.' 00:00:00';
        $end_date      = $end_date.' 23:59:59';
        $handler_id    = request('handler_id');
        $category      = request('category');
        $type          = request('type');
        $custom_filter = request('custom-filter-check');
        $full_date     = $date_array[0].'_'.$date_array[1];

        $cases       = (new Cases)->submittedCases();
        if (is_null($handler_id)):
            if (isset($custom_filter)):
                $cases   = (new Cases)->getCaseByDateRangeTypeAndCategory($start_date, $end_date, $category, $type);
            else:
                $cases   = (new Cases)->getCaseByDateRange($start_date, $end_date);
            endif;
        else:
            if (isset($custom_filter)):
                $cases   = (new Cases)->getCaseByDateRangeTypeCategoryAndHandler($start_date, $end_date, $handler_id, $category, $type);
            else:
                $cases   = (new Cases)->getCaseByDateRangeAndHandler($start_date, $end_date, $handler_id);
            endif;
        endif;

        $csvExporter = new \Laracsv\Export();

        $csvExporter->beforeEach(function ($case) {
            $case->case_category = \AppHelper::value('case_categories', $case->case_category);
            $case->case_type     = \AppHelper::value('case_types', $case->case_type);
            $case->submitted_on  = $case->getSubmittedAt();
            $case->case_handler  = $case->getHandlerFullName();
            $case->amount_paid   = formatNumber($case->amount_paid);
        });

        $csvExporter->build($cases, ['submitted_on', 'subject', 'amount_paid', 'case_handler', 'case_category', 'case_type'])->download('case_report_'.$full_date.'.csv');
    }

    /**
     * Send response.
     *
     * @param string $message
     * @param string $responseType
     * @param mixed $response
     * @return void
     */
    public function sendResponse(
        string $message,
        string $responseType,
        $response = null
    ) {
        echo json_encode([
            'message' => $message,
            'responseType' => $responseType,
            'response' => $response,
        ]);
        exit();
    }
}
