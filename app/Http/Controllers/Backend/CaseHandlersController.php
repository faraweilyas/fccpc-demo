<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Auth;

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
     * @param int $id
     * @return void
     */
    public function index()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Case Handlers Dashboard";
        $details          = details($title, $description);
        return view('backend.'.getAccountType().'.case-handlers', compact('details'));
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
    	return view('backend.'.getAccountType().'.create-handler', compact('details'));
    }

    /**
     * Handles the store handler page route.
     * @return void
     */
    public function storeHandler(Request $request)
    {
        $this->validate($request, [
            'firstName'       => ['required', 'string', 'max:255'],
            'lastName'        => ['required', 'string', 'max:255'],
            'email'           => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $user = \App\User::create([
            'firstName'     => trim(ucfirst($request->firstName)),
            'lastName'      => trim(ucfirst($request->lastName)),
            'email'         => $request->email,
            'password'      => Hash::make(trim(ucfirst($request->firstName)).'123'),
            'accountType'   => "CH",
        ]);

        if ($user) {
            Session::flash('success', "Case handler created sucessfully");
            return redirect()->back();
        } else {
            Session::flash('error', "Case handler not created sucessfully.");
            return redirect()->back();
        }
    }

    /**
     * Handles the view case handlers page route.
     * @return void
     */
    public function show($id)
    {
        $handler          = \App\User::whereId($id)->first();
        $title            = APP_NAME;
        $description      = "FCCPC View Case Handler Dashboard";
        $details          = details($title, $description);
        return view('backend.'.getAccountType().'.view-case-handler', compact('details', 'handler'));
    }

    public function updateHandlerStatus($id)
    {
        $check_status = \App\User::findOrFail($id);

        $result = \App\User::whereId($id)->update([
                'status' => !$check_status->status
         ]);

        if ($result) {
            Session::flash('success', "Case handler's status updated");
            return redirect()->back();
        } else {
            Session::flash('error', "Case handler's status not updated.");
            return redirect()->back();
        }
    }
 }
