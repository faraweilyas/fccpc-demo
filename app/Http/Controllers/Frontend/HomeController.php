<?php

namespace App\Http\Controllers\Frontend;

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
    public function faq()
    { 
    	$title            = "Frequently Asked Questions (FAQs) - Federal Competition and Consumer Protection Commission - ".APP_NAME;
	    $description      = "FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.";
    	$details          = details($title, $description);
    	return view('frontend.faq', compact('details'));
    } 
}