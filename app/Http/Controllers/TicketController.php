<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Categories;
use App\Department;
use Session;
use Auth;
use App\User;
use App\TicketBitacora;
use DB;

class TicketController extends Controller
{
    //
	public function __construct(){
		$this->middleware('auth');
	}

    public function index(){	   
	    $categories = Categories::all();
	    $departments = Department::all();

	    return view('solicitudes.create', compact('categories', 'departments'));
	}

	public function store(Request $request){

		$reglas = [
	        'title'     	=> 'required',
	        'category'  	=> 'required|integer',
	        'priority'  	=> 'required|string',
	        'message'   	=> 'required|string|max:1000',
	        'tipo' 			=> 'required|boolean',
	        'department'	=> 'required',
	        'encargado' 	=> 'required'		
        ];

		$mensajes = [
        	'title.required'    	=> 'El título del ticket es necesario.',
        	'category.required' 	=> 'Debe seleccionar una categoría para el ticket.',
        	'priority.required' 	=> 'Debe seleccionar una prioridad.',
        	'message.required'  	=> 'Debe llenar el campo de mensaje.',
        	'message.max'  			=> 'La cantidad máxima de caracteres para el mensaje es de 1000.',
        	'tipo.required' 		=> 'Debe seleccionar un tipo para el ticket.',
        	'tipo.boolean' 			=> 'El tipo seleccionado para el ticket no es un valor aceptado, contacte al administrador.',
        	'encargado.required'	=> 'No se encuentra un coordinador asociado al departamento, contacte al administrador.'
    	];

    	$id_encargado = "";

    	$ids = DB::table('department')
    		->join('users', function($join){
    			$join->on('department.id', '=', 'users.departamento_id')
    			->where('users.cargo_id', '=', 4);                
    		})            
            ->where('departamento_id', '=', $request['department'])
    		->select('users.id')->get();
            
		foreach ($ids as $default) {
	    	$id_encargado = $default->id;
		}
        
        $request->request->add(['encargado' => $id_encargado]);

	    $this->validate($request, $reglas, $mensajes);

	    array_except($request->all(), ['encargado']);
    		
        $department = \App\Department::where('id', Auth::user()->departamento_id)->get();

        foreach ($department as $dep) {
            $iniciales = $dep->iniciales;
        }

        $fechaTicket = date("Y").date("m").date("d");

        $cant_tickets = Ticket::count() + 1;        

        if($request->input('priority') === "inmediato"){
            $fecha = date('Y-m-d H:i:s');
            $nuevafecha = strtotime ( '+4 hour' , strtotime ( $fecha ) ) ;
            $nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );             
        }
        else{
            if($request->input('priority') === "imperativo"){
                $fecha = date('Y-m-d H:i:s');
                $nuevafecha = strtotime ( '+24 hour' , strtotime ( $fecha ) ) ;
                $nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );             
            }                
            else{
                if($request->input('priority') === "prudente"){
                    $fecha = date('Y-m-d H:i:s');
                    $nuevafecha = strtotime ( '+48 hour' , strtotime ( $fecha ) ) ;
                    $nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );             
                }
                else{
                    if($request->input('priority') === "moderado"){
                        $fecha = date('Y-m-d H:i:s');
                        $nuevafecha = strtotime ( '+72 hour' , strtotime ( $fecha ) ) ;
                        $nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );             
                    }
                    else{
                        if($request->input('priority') === "leve"){
                            $fecha = date('Y-m-d H:i:s');
                            $nuevafecha = strtotime ( '+120 hour' , strtotime ( $fecha ) ) ;
                            $nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );             
                        }
                        else{
                            if($request->input('priority') === "premeditado"){
                                $fecha = date('Y-m-d H:i:s');
                                $nuevafecha = strtotime ( '+720 hour' , strtotime ( $fecha ) ) ;
                                $nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );             
                            }
                        }
                    }
                }
            }
        }       

        $fecha_atencion = $nuevafecha;        
        
        $ticket = new Ticket([
            'title'     		=> $request->input('title'),
            'user_id'   		=> Auth::user()->id,
            'user_default_id' 	=> $id_encargado,
            'user_assigned_id' 	=> $id_encargado,
            'ticket_id' 		=> $iniciales. "-" . $fechaTicket . "-" . $cant_tickets,
            'category_id'  		=> $request->input('category'),
            'department_id'		=> $request['department'],
            'type'				=> $request['tipo'],
            'priority'  		=> $request->input('priority'),
            'message'   		=> $request->input('message'), 
            'fecha_atencion'    => $fecha_atencion,           
            'status'    		=> "Open",
        ]);

        $bitacora = new TicketBitacora([
            'user_id'   => $id_encargado,
            'ticket_id' => $ticket->ticket_id,
        ]);

        $bitacora->save();

        $ticket->save();

        User::find($id_encargado)->notify(new \App\Notifications\NewTicket($id_encargado, Auth::user(), $ticket->ticket_id));

        //event(new \App\Events\TicketCreated('Hi there Pusher!'));

        return redirect()->back()->with("status", "Se ha abierto un nuevo ticket con el código: " . $ticket->ticket_id);
	}

	public function show($ticket_id){
	    $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
	    $comments = $ticket->comments;
	    $category = Categories::where('id', $ticket->category_id)->firstOrFail();
        $empleados = User::where('departamento_id', $ticket->department_id)->get();
        $bitacora = TicketBitacora::where('ticket_id', $ticket_id)->get();
        $users = \App\User::all();
        $departments = \App\Department::where('id', "NOT LIKE", $ticket->department_id)->get();

	    return view('solicitudes.show', compact('comments', 'category', 'ticket', 'empleados', 'bitacora', 'users', 'departments'));
	}

    public function update(Request $request, $id){
        $input = ['user_assigned_id' => $request['asignar']];
        \App\Ticket::where('id', $id)->update($input);

        echo "Ticket delegado";
    }

    public function close($ticket_id)
    {   
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();
        $ticket->status = 'Closed';
        $ticket->save();
        return redirect()->back()->with("status", "El ticket " . $ticket_id . " se ha cerrado.");
    }
}
