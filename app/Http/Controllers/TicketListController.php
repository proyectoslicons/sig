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
        $arr2 = [
            ['user_id', 'NOT LIKE', Auth::user()->id],
            ['status',  'NOT LIKE', 'Closed'],
            ['user_default_id', '=', Auth::user()->id]  
        ];

        $arr3 = [
            ['user_id', 'NOT LIKE', Auth::user()->id],
            ['status',  'NOT LIKE', 'Closed'],
            ['user_assigned_id', '=', Auth::user()->id] 
        ];

        $tickets = Ticket::where($arr2)
                         ->orwhere($arr3)
                         ->get();
                         
        $categories = Categories::all();    

        return view('solicitudes.index', compact('tickets', 'categories'));
    }

    public function creados(){
        $arr = [
            ['status',  'NOT LIKE', 'Closed'],
            ['user_id', '=', Auth::user()->id]  
        ];

        $tickets_creados = Ticket::where($arr)->get();
                         
        $categories = Categories::all();    

        return view('solicitudes.index2', compact('categories', 'tickets_creados'));
    }

    public function cerrados(){
        $arr2 = [
            ['user_id', 'NOT LIKE', Auth::user()->id],
            ['status',  'LIKE', 'Closed'],
            ['user_default_id', '=', Auth::user()->id]  
        ];

        $arr3 = [
            ['user_id', 'NOT LIKE', Auth::user()->id],
            ['status',  'LIKE', 'Closed'],
            ['user_assigned_id', '=', Auth::user()->id] 
        ];

        $tickets = Ticket::where($arr2)
                         ->orwhere($arr3)
                         ->get();
                         
        $categories = Categories::all();    

        return view('solicitudes.cerrados', compact('tickets', 'categories'));
    }

    public function cerradosUsuario(){
        $arr = [
            ['status',  'LIKE', 'Closed'],
            ['user_id', '=', Auth::user()->id]  
        ];

        $tickets_creados = Ticket::where($arr)->get();
                         
        $categories = Categories::all();    

        return view('solicitudes.cerrados2', compact('categories', 'tickets_creados'));
    }
}
