<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
	/**
	 * Handles the home page route.
	 * @return void
	 */
    public function index()
    {
    	$title            = APP_NAME;
	    $description      = "FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.";
    	$details          = details($title, $description);
    	return view('frontend.index', compact('details'));
    }

    /**
	 * Handles the fee calculator page route.
	 * @return void
	 */
    public function feeCalcutor()
    {
    	$title          = "Fee Calculator - ".APP_NAME;
	    $description    = "FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.";
    	$details          = details($title, $description);
    	return view('frontend.fee-calculator', compact('details'));
    }

    /**
     * Handles the faq page route.
     * @return void
     */
    public function faq($type = null)
    {
        if ($type != null):
            $faq          = Faq::where('category', $type)->get();
        else :
            $faq          = Faq::all();
        endif;

        $title            = "Frequently Asked Questions (FAQs) - Federal Competition and Consumer Protection Commission - ".APP_NAME;
        $description      = "FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.";
        $details          = details($title, $description);
        return view('frontend.faq', compact('details', 'faq', 'type'));
    }

    /**
     * Handles the faq page route.
     * @return void
     */
    public function faqDetails($id)
    {
        $faq              = Faq::find($id);
        $title            = "Frequently Asked Questions (FAQs) - Federal Competition and Consumer Protection Commission - ".APP_NAME;
        $description      = "FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.";
        $details          = details($title, $description);
        return view('frontend.faq-single', compact('details', 'id', 'faq'));
    }

    /**
     * Handles the update faq feedback route.
     * @return void
     */
    public function updateFaqFeedback($id, $question)
    {
        $ip = request()->ip();
        if(Feedback::where('question_id', $question)->where('ip_address', $ip)->first()):
            Feedback::where('question_id', $question)->where('ip_address', $ip)->update([
                'feedback' => $id
            ]);
            return redirect()->back()->with('success', 'Feedback saved successfully');
        else:
            Feedback::create([
                'question_id' => $question,
                'ip_address' => $ip,
                'feedback' => $id
            ]);
            return redirect()->back()->with('success', 'Feedback saved successfully');
        endif;

        return redirect()->back();
    }
}
