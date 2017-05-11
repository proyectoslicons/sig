<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Category;

class TicketListController extends Controller
{
    //
	public function __construct(){
		$this->middleware('auth');
	}

    public function index(){	   
	    $tickets = Ticket::all();
	    $categories = Category::all();	    

	    return view('solicitudes.index', compact('tickets', 'categories'));
	}
}
