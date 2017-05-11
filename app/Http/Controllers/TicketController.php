<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Category;
use Auth;

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

	public function store(Request $request){
	    $this->validate($request, [
	            'title'     => 'required',
	            'category'  => 'required',
	            'priority'  => 'required',
	            'message'   => 'required'
	        ]);

	        $ticket = new Ticket([
	            'title'     => $request->input('title'),
	            'user_id'   => Auth::user()->id,
	            'ticket_id' => strtoupper(str_random(10)),
	            'category_id'  => $request->input('category'),
	            'priority'  => $request->input('priority'),
	            'message'   => $request->input('message'),
	            'status'    => "Open",
	        ]);

	        $ticket->save();

	        return redirect()->back()->with("status", "Se ha abierto un nuevo ticket con el código: $ticket->ticket_id");
	}

	public function show($ticket_id){
	    $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
	    $comments = $ticket->comments;
	    $category = $ticket->category;
	    return view('solicitudes.show');
	}
}
