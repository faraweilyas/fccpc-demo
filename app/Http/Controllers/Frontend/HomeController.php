<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use App\Models\Feedback;
use App\Models\Publication;
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
        $title = APP_NAME;
        $description =
            'FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.';
        $details = details($title, $description);
        return view('frontend.index', compact('details'));
    }

    /**
     * Handles the fee calculator page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function feeCalcutor()
    {
        $title = 'Fee Calculator - ' . APP_NAME;
        $description =
            'FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.';
        $details = details($title, $description);
        return view('frontend.fee-calculator', compact('details'));
    }

    /**
     * Handles the publications page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function publications()
    {
        $search               = $_GET['query'] ?? "";
        $case_type1           = $_GET['case_type1'] ?? "";
        $case_type2           = $_GET['case_type2'] ?? "";
        $case_category1       = $_GET['case_category1'] ?? "";
        $case_category2       = $_GET['case_category2'] ?? "";

        $publications     = Publication::where('published_at', '!=', NULL)
                            ->whereHas('case',
                                function($query)
                                use (
                                        $search,
                                        $case_type1,
                                        $case_type2,
                                        $case_category1,
                                        $case_category2
                                )
                            {
                                $query->where('subject', 'like', '%'.$search.'%');
                                if (!empty($case_type1) || !empty($case_type2))
                                    $query->whereIn('case_type', [$case_type1, $case_type2]);

                                if (!empty($case_category1) || !empty($case_category2))
                                    $query->whereIn('case_category', [$case_category1, $case_category2]);
                            })
                            ->orderBy('id', 'DESC')
                            ->paginate(10);

        $title          = 'Publications - ' . APP_NAME;
        $description    = 'FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.';
        $details        = details($title, $description);
        return view('frontend.publications', compact('details' , 'publications'));
    }

    /**
     * Handles the publications view page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function publicationView($slug)
    {
        $publication = Publication::where('slug', $slug)->first();
        $title = 'Publications - ' . APP_NAME;
        $description =
            'FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.';
        $details = details($title, $description);
        return view(
            'frontend.publications-single',
            compact('details', 'publication')
        );
    }

    /**
     * Handles the resources page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function resources()
    {
        $title = 'Resources - ' . APP_NAME;
        $description =
            'FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.';
        $details = details($title, $description);
        return view('frontend.resources', compact('details'));
    }

    /**
     * Handles the faqs page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function faqs()
    {
        return redirect()->back();

        $faq_categories = \AppHelper::get('faq_categories');
        $title = 'Frequently Asked Questions (FAQs) - ' . APP_NAME;
        $description =
            'FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.';
        $details = details($title, $description);
        return view('frontend.faqs', compact('details', 'faq_categories'));
    }

    /**
     * Handles the faq search page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function faqSearch()
    {
        $search_param = $_GET['query'] ?? '';
        $faq = Faq::where(
            'question',
            'LIKE',
            '%' . $search_param . '%'
        )->first();
        if (!is_null($faq)) {
            $related_faq = Faq::where(
                'question',
                'LIKE',
                '%' . $search_param . '%'
            )->get();
        }
        $title = 'Frequently Asked Questions (FAQs) - ' . APP_NAME;
        $description =
            'FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.';
        $details = details($title, $description);
        if (is_null($faq)) {
            return redirect()->route('home.faqs.NotFound');
        }
        return view(
            'frontend.faq-search',
            compact('details', 'faq', 'related_faq')
        );
    }
    /**
     * Handles the faq NotFound page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function faqNotFound()
    {
        $title = 'Frequently Asked Questions (FAQs) - ' . APP_NAME;
        $description =
            'FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.';
        $details = details($title, $description);
        return view(
            'frontend.faq-not-found',
            compact('details')
        );
    }

    /**
     * Handles the faqs category view page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function faqCategoryView($category)
    {
        $faq = Faq::where('category', $category)->first();
        if (!is_null($faq)) {
            $related_faq = $faq->where('category', $category)->get();
        }
        $title = 'Frequently Asked Questions (FAQs) - ' . APP_NAME;
        $description =
            'FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.';
        $details = details($title, $description);
        if (is_null($faq)) {
            return redirect()->route('home.faqs.NotFound');
        }
        return view(
            'frontend.faq-single',
            compact('details', 'faq', 'related_faq')
        );
    }

    /**
     * Handles the faq page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function faq($category, $slug)
    {
        $faq = Faq::where('slug', $slug)->first();
        $related_faq = $faq->where('category', $category)->get();
        $title = 'Frequently Asked Questions (FAQs) - ' . APP_NAME;
        $description =
            'FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.';
        $details = details($title, $description);
        return view(
            'frontend.faq-single',
            compact('details', 'faq', 'related_faq')
        );
    }

    /**
     * Handles the store feedback route.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function storeFeedback(Faq $faq)
    {
        Feedback::updateOrcreate(
            [
                'ip_address' => request()->ip(),
                'faq_id' => $faq->id,
            ],
            [
                'feedback' => request('feedback'),
            ]
        );

        return back()->with('success', 'Thanks for your feedback');
    }
}
