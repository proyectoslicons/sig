<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Category;
use DB;

class TicketListController extends Controller
{
    //
	public function __construct(){
		$this->middleware('auth');
	}

    public function index(){	   
	    $tickets = Ticket::where('status', 'Open')->get();
	    $categories = Category::all();	    

	    return view('solicitudes.index', compact('tickets', 'categories'));
	}
}
