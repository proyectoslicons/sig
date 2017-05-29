<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Category;
use Session;
use Auth;
use App\User;

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

		$reglas = [
	        'title'     => 'required',
	        'category'  => 'required',
	        'priority'  => 'required',
	        'message'   => 'required'
        ];

		$mensajes = [
        	'title.required'    => 'El título del ticket es necesario.',
        	'category.required' => 'Debe seleccionar una categoría para el ticket.',
        	'priority.required' => 'Debe seleccionar una prioridad.',
        	'message.required'  => 'Debe llenar el campo de mensaje.',
    	];

	    $this->validate($request, $reglas, $mensajes);

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

	        User::find(3003)->notify(new \App\Notifications\NewTicket(Auth::user(), $ticket->ticket_id));

	        //event(new \App\Events\TicketCreated('Hi there Pusher!'));

	        return redirect()->back()->with("status", "Se ha abierto un nuevo ticket con el código: $ticket->ticket_id");
	}

	public function show($ticket_id){
	    $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
	    $comments = $ticket->comments;
	    $category = $ticket->category;
	    return view('solicitudes.show', compact('comments', 'category', 'ticket'));
	}
}
