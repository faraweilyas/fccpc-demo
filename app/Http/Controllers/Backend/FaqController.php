<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

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
}
