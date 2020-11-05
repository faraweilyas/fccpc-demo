<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Models\User;
use App\Models\Cases;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewUser;
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
	 * @return void
	 */
    public function index()
    {
        if(in_array(\Auth::user()->account_type, ['SP'])):
            $new_cases = (new Cases())->unassignedCases()->take(5);
        else:
            $new_cases = auth()
                    ->user()
                    ->active_cases_assigned_to()
                    ->get()->take(5);
        endif;
        $cases            = new Cases();
    	$title            = APP_NAME;
        $description      = "FCCPC Dashboard";
    	$details          = details($title, $description);
    	return view('backend.admin.index', compact('details', 'cases', 'new_cases'));
    }

    /**
     * Handles the create user page route.
     * @return void
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
     * @return void
     */
    public function storeUser(Request $request)
    {
        $this->validate($request, [
            'firstName'       => ['required', 'string', 'max:255'],
            'lastName'        => ['required', 'string', 'max:255'],
            'email'           => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'accountType'     => 'required',
        ]);

        User::create([
            'first_name'     => trim(ucfirst($request->firstName)),
            'last_name'      => trim(ucfirst($request->lastName)),
            'email'         => $request->email,
            'password'      => Hash::make(config('app.default_password')),
            'account_type'   => $request->accountType,
        ]);

        $user->notify(
                new NewUser($request->email, config('app.default_password'))
            );   

        return redirect()->back()->with("success", "User created sucessfully");
    }

    /**
     * Handles the view users page route.
     * @return void
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
     * @return void
     */
    public function viewProfile()
    {
        $user             = Auth::user();
        $title            = APP_NAME;
        $description      = "FCCPC Dashboard View Profile";
        $details          = details($title, $description);
        return view('backend.user.profile', compact('details', 'user'));
    }

    public function updateUserStatus($id)
    {
        $check_status = User::findOrFail($id);

        User::whereId($id)->update([
            'status' => ($check_status->status == 'active') ? 'inactive' : 'active'
        ]);

        return redirect()->back()->with("success", "User's status updated");
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'first_name'    => 'required',
            'last_name'     => 'required'
        ]);

        if (isset($request->password) && $request->change_pass == 'yes') {
            if (Hash::check($request->password, Auth::user()->password)) {
                if ($request->new_password === $request->password_confirmation) {
                    User::whereId(Auth::user()->id)->update([
                            'first_name' => $request->first_name,
                            'last_name'  => $request->last_name,
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

        User::whereId(Auth::user()->id)->update([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name
         ]);

        return redirect()->back()->with("success", "Profile updated");
    }

    /**
     * Handles the generate report page route.
     * @return void
     */
    public function generateReport()
    {
        $handlers         = User::where('account_type', 'CH')->where('status', 'active')->get();
        $title            = APP_NAME;
        $description      = "FCCPC Dashboard Generate Report";
        $details          = details($title, $description);
        return view('backend.admin.generate-report', compact('details', 'handlers'));
    }

    /**
     * Handles the export report to csv page route.
     * @return void
     */
    public function exportReportCSV()
    {
        $date_array    = explode(' to ', request('start_date_end_date')) ;
        $start_date    = $date_array[0];
        $end_date      = $date_array[1];
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

        $csvExporter = new \Laracsv\Export();

        $csvExporter->beforeEach(function ($case) {
            $case->case_category = \AppHelper::value('case_categories', $case->case_category);
            $case->case_type     = \AppHelper::value('case_types', $case->case_type);
        });

        $csvExporter->build($cases, ['subject', 'parties', 'case_category', 'case_type', 'applicant_firm', 'applicant_fullname', 'applicant_email', 'applicant_phone_number', 'applicant_address', 'submitted_at'])->download('case_report.csv');
    }
}
