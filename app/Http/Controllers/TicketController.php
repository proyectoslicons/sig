<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
	public function __construct(){
		$this->middleware('auth');
	}

    public function index(){	   
	    $categories = Category::all();

	    return view('solicitudes.create', compact('categories'));
	}
}
