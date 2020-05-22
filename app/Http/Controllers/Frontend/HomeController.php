<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    { 
    	$title            = APP_NAME;
	    $description      = "FCCPC is the apex consumer protection agency in Nigeria established to improve the well-being of the people.";
    	$details          = details($title, $description);
    	return view('frontend.index', compact('details'));
    } 
}