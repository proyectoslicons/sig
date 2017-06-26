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
    	$arr = [
    		['status', 	'NOT LIKE',	'Closed'],
    		['user_id', '=', Auth::user()->id]	
    	];

    	$arr2 = [
    		['status', 	'NOT LIKE',	'Closed'],
    		['user_default_id', '=', Auth::user()->id]	
    	];

    	$arr3 = [
    		['status', 	'NOT LIKE',	'Closed'],
    		['user_assigned_id', '=', Auth::user()->id]	
    	];

	    $tickets = Ticket::where($arr)
	    				 ->orwhere($arr2)
	    				 ->orwhere($arr3)
	    				 ->get();
	    				 
	    $categories = Categories::all();	    

	    return view('solicitudes.index', compact('tickets', 'categories'));
	}
}
