<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CaseHandlersController extends Controller
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
     * Handles the Case handlers display page route.
     * @return void
     */
    public function index()
    {   
        $handlers         = (new User)->caseHandlers();
        $title            = APP_NAME;
        $description      = "FCCPC Case Handlers Dashboard";
        $details          = details($title, $description);
        return view('backend.cases.case-handlers', compact('details', 'handlers'));
    }

	/**
	 * Handles the create case handlers page route.
	 * @return void
	 */
    public function create()
    {
    	$title            = APP_NAME;
        $description      = "FCCPC Create Handler Dashboard";
    	$details          = details($title, $description);
    	return view('backend.cases.create-handler', compact('details'));
    }

    /**
     * Handles the store handler page route.
     * @return void
     */
    public function storeHandler(Request $request)
    {
        $validated      = request()->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName'  => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $validated['password']      = Hash::make(config('app.default_password'));
        $validated['accountType']   = "CH";
        $user                       = User::create($validated);

        return redirect()->back()->with("success", "Case handler has been registered sucessfully");
    }

    /**
     * Handles the view case handlers page route.
     * @return void
     */
    public function show($id)
    {
        $handler          = User::whereId($id)->first();
        $title            = APP_NAME;
        $description      = "FCCPC View Case Handler Dashboard";
        $details          = details($title, $description);
        return view('backend.cases.view-case-handler', compact('details', 'handler'));
    }

    /**
     * Handles the update case handler status page route.
     * @return void
     */
    public function updateHandlerStatus(User $handler)
    {
        $status    = $handler->status;
        $type      = ($status == 'active') ? 'error' : 'success'; 
        $message   = ($status == 'active') ? 'Case handler deactivated' : 'Case handler activated'; 
        User::whereId($handler->id)->update([
            'status' => ($status == 'active') ? 'inactive' : 'active',
        ]);

        return redirect()->back()->with($type, $message);
    }
 }
