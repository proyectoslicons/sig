<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\Categories;
use DB;

class TicketListController extends Controller
{
    //
	public function __construct(){
		$this->middleware('auth');
	}

    public function index(){	   
	    $tickets = Ticket::where('status', 'Open')
	    ->where('user_id', Auth::user()->id)
	    ->orwhere('user_default_id', Auth::user()->id)
	    ->orwhere('user_assigned_id', Auth::user()->id)
	    ->get();
	    $categories = Categories::all();	    

	    return view('solicitudes.index', compact('tickets', 'categories'));
	}
}
