<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Handles the home page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $title            = APP_NAME;
        $description      = "FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.";
        $details          = details($title, $description);
        return view('frontend.index', compact('details'));
    }

    /**
     * Handles the fee calculator page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function feeCalcutor()
    {
        $title          = "Fee Calculator - ".APP_NAME;
        $description    = "FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.";
        $details        = details($title, $description);
        return view('frontend.fee-calculator', compact('details'));
    }

    /**
     * Handles the faqs page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function faqs()
    {
        $category       = request('category');
        $faqs           = (is_null($category))
                        ? Faq::all()
                        : Faq::where('category', $category)->get();
        $title          = "Frequently Asked Questions (FAQs) - ".APP_NAME;
        $description    = "FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.";
        $details        = details($title, $description);
        return view('frontend.faqs', compact('details', 'faqs', 'category'));
    }

    /**
     * Handles the faq page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function faq(Faq $faq)
    {
        $title          = "Frequently Asked Questions (FAQs) - ".APP_NAME;
        $description    = "FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.";
        $details        = details($title, $description);
        return view('frontend.faq-single', compact('details', 'faq'));
    }

    /**
     * Handles the store feedback route.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function storeFeedback(Faq $faq)
    {
        Feedback::updateOrcreate([
            'ip_address'    => request()->ip(),
            'question_id'   => $faq->id,
        ], [
            'feedback'      => request('feedback')
        ]);

        return back()->with('success', 'Thanks for your feedback');
    }
}
