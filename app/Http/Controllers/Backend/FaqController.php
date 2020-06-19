<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    /**
     * Handles the create faq page route.
     * @return void
     */
    public function index()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Create Faq Dashboard";
        $details          = details($title, $description);
        return view('backend.faq.index', compact('details'));
    }

    /**
     * Handles the faq logs page route.
     * @return void
     */
    public function logs()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Faq Logs Dashboard";
        $details          = details($title, $description);
        return view('backend.faq.logs', compact('details'));
    }

    /**
     * Handles the faq edit page route.
     * @return void
     */
    public function edit($id)
    {
        $faq              = Faq::where('id', $id)->first();
        $title            = APP_NAME;
        $description      = "FCCPC Faq Edit Log Dashboard";
        $details          = details($title, $description);
        return view('backend.faq.edit', compact('details', 'faq'));
    }

    /**
     * Handles the store faq page route.
     * @return void
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'question'    => 'required',
            'answer'      => 'required',
            'category'    => 'required',
        ]);

        $result = Faq::where('id', '=', $request->id)->update([
            'creator'   => Auth::user()->id,
            'question'  => trim($request->question),
            'answer'    => trim($request->answer),
            'category'  => trim($request->category),
        ]);

        return redirect()->back()->with("success", "Faq updated successfully!");
    }

    /**
     * Handles the store faq page route.
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question'    => 'required',
            'answer'      => 'required',
            'category'    => 'required',
        ]);

        $result = Faq::create([
            'creator'   => Auth::user()->id,
            'question'  => trim($request->question),
            'answer'    => trim($request->answer),
            'category'  => trim($request->category),
        ]);

        return redirect()->back()->with("success", "Faq created successfully!");
    }

    /**
     * Handles the destroy faq page route.
     * @return void
     */
    public function destroy($id)
    {
        $faq = Faq::find($id);
        if($faq):
            $destroy = Faq::destroy($id);
            return redirect()->back()->with("error", "Faq removed successfully!");
        endif;
    }
}
