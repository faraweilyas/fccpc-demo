<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    { 
    	$details          = details('Discover Great Dishes Around You');
    	return view('frontend.index', compact('details'));
    } 
}