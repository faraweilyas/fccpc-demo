<?php

namespace App\Http\Controllers\Backend;

use App\Models\Faq;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Handles the create faq page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $title            = "Create FAQ - ".APP_NAME;
        $description      = "Create FAQ - ".APP_NAME;
        $details          = details($title, $description);
        return view('backend.faq.create', compact('details'));
    }

    /**
     * Handles the faq logs page route.
     * @return void
     */
    public function index()
    {
        $title            = APP_NAME;
        $description      = "FCCPC Faq Logs Dashboard";
        $details          = details($title, $description);
        return view('backend.faq.logs', compact('details'));
    }

    /**
     * Handles the view faq detail page route.
     * @return void
     */
    public function viewFaqDetail(Faq $faq)
    {
        $title            = APP_NAME;
        $description      = "FCCPC Faq Detail";
        $details          = details($title, $description);
        return view('backend.admin.faq-detail', compact('details', 'faq'));
    }

    /**
     * Handles the faq edit page route.
     * @return void
     */
    public function edit(Faq $faq)
    {
        $title            = APP_NAME;
        $description      = "FCCPC Faq Edit Log Dashboard";
        $details          = details($title, $description);
        return view('backend.faq.edit', compact('details', 'faq'));
    }

    /**
     * Handles the store faq page route.
     * @return void
     */
    public function update(Request $request, Faq $faq)
    {
         $this->validate($request, [
            'question'    => 'required',
            'answer'      => 'required',
        ]);

        $faq->where('id', $faq->id)->update([
            'user_id'   => Auth::user()->id,
            'slug'      => Str::slug(request('question')),
            'question'  => trim(request('question')),
            'answer'    => trim(request('answer')),
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
        ]);

        $result = Faq::create([
            'user_id'   => Auth::user()->id,
            'slug'      => Str::slug(request('question')),
            'question'  => trim(request('question')),
            'answer'    => trim(request('answer')),
            'category'  => 'GEN',
        ]);

        return redirect()->back()->with("success", "Faq created successfully!");
    }

    /**
     * Handles the destroy faq page route.
     * @return void
     */
    public function destroy(Faq $faq)
    {
        $faq->destroy($faq->id);
        return redirect()->back()->with("error", "Faq removed successfully!");
    }
}
