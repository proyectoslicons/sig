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
use App\Attachment;
use DB;
use Storage;

class TicketController extends Controller
{
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
            'title'         => 'required',
            'category'      => 'required|integer',
            'priority'      => 'required|string',
            'message'       => 'required|string|max:1000',
            'tipo'          => 'required|boolean',
            'department'    => 'required',
            'encargado'     => 'required'       
        ];

        $mensajes = [
            'title.required'        => 'El título del ticket es necesario.',
            'category.required'     => 'Debe seleccionar una categoría para el ticket.',
            'priority.required'     => 'Debe seleccionar una prioridad.',
            'message.required'      => 'Debe llenar el campo de mensaje.',
            'message.max'           => 'La cantidad máxima de caracteres para el mensaje es de 1000.',
            'tipo.required'         => 'Debe seleccionar un tipo para el ticket.',
            'tipo.boolean'          => 'El tipo seleccionado para el ticket no es un valor aceptado, contacte al administrador.',
            'encargado.required'    => 'No se encuentra un coordinador asociado al departamento, contacte al administrador.'
        ];

        $files = $request->file('archivos');
        $i = 0;

        if(count($files) > 0 )
        foreach ($files as $file) {
            $request->request->add(['archivo'.$i => $file]); 
            $reglas['archivo'.$i] = 'mimes:jpeg,png,doc,docx,xls,xlsx,ppt,pptx,pdf';
            $mensajes['archivo'.$i.'.mimes'] = 'Sólo se aceptan formatos jpeg, png, doc, docx, xls, xlsx, ppt, pptx, pdf.';   
            $i++;             
        } 		

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

        $files = $request->file('archivos');

        if(count($files) > 0)
        foreach ($files as $file) {
            $nombre_archivo = $ticket->ticket_id. "_" . $file->getClientOriginalName();
            $file->storeAs('', $nombre_archivo);
            $adjunto = new Attachment([
                'ticket_id' => $ticket->ticket_id,
                'user_id'   => Auth::id(),
                'filename'  => $nombre_archivo
            ]);
            $adjunto->save();
        }       

        $bitacora->save();

        $ticket->save();

        User::find($id_encargado)->notify(new \App\Notifications\NewTicket($id_encargado, Auth::user(), $ticket->ticket_id));

        return redirect()->back()->with("status", "Se ha abierto un nuevo ticket con el código: " . $ticket->ticket_id);
	}

	public function show($ticket_id){
	    $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

	    $comments = $ticket->comments;
	    
        $category = Categories::where('id', $ticket->category_id)->firstOrFail();
        
        $empleados = User::where('departamento_id', $ticket->department_id)
                    ->where('id', 'NOT LIKE', Auth::id())
                    ->get();
        
        $bitacora = TicketBitacora::where('ticket_id', $ticket_id)->get();
        
        $users = \App\User::all();
        
        $departments = \App\Department::where('id', "NOT LIKE", $ticket->department_id)->get();

        $usuario_notificado = \App\Ticket_Notification::where('ticket_id', $ticket_id)->First();

        if($usuario_notificado->user_id === Auth::id() && $usuario_notificado->status === 0){
            $input = ['status' => 1];
            \App\Ticket_Notification::where('ticket_id', $ticket_id)->update($input);  
        }

        $attachments = Attachment::where('ticket_id', $ticket_id)->get();      

	    return view('solicitudes.show', compact('comments', 'category', 'ticket', 'empleados', 'bitacora', 'users', 'departments', 'attachments'));
	}

    public function delegar(Request $request){
        $input = ['user_assigned_id' => $request['id_asignar']];

        $bitacora = new TicketBitacora([
            'user_id'   => $request['id_asignar'],
            'ticket_id' => $request['ticket_id'],
        ]);

        $bitacora->save();

        User::find($request['id_asignar'])->notify(new \App\Notifications\NewTicket($request['id_asignar'], Auth::user(), $request['ticket_id']));

        \App\Ticket::where('ticket_id', $request['ticket_id'])->update($input);
        $encargado = User::find($request['id_asignar']);
        $nombre = ucwords($encargado->primer_nombre . " " . $encargado->primer_apellido);
        return redirect()->back()->with("status", "Se ha delegado el ticket a: " . $nombre);
    }

    public function escalar(Request $request){
        
        $id_encargado = "";

        $ids = DB::table('department')
            ->join('users', function($join){
                $join->on('department.id', '=', 'users.departamento_id')
                ->where('users.cargo_id', '=', 4);                
            })            
            ->where('departamento_id', '=', $request['departamento_id'])
            ->select('users.id')->get();
            
        foreach ($ids as $default) {
            $id_encargado = $default->id;
        }

        $input = [
            'user_default_id'   => $id_encargado, 
            'user_assigned_id'  => $id_encargado,
            'department_id'     => $request['departamento_id']
        ];

        $bitacora = new TicketBitacora([
            'user_id'   => $id_encargado,
            'ticket_id' => $request['ticket_id'],            
        ]);

        $bitacora->save();

        User::find($id_encargado)->notify(new \App\Notifications\NewTicket($id_encargado, Auth::user(), $request['ticket_id']));

        \App\Ticket::where('ticket_id', $request['ticket_id'])->update($input);
        
        $departamento = \App\Department::find($request['departamento_id']);        

        Session::flash('status', "Se ha escalado el ticket " . $request['ticket_id'] . " a la unidad funcional: " . $departamento->name);
        return redirect()->intended('solicitudes/listarTickets');

    }

    public function close(Request $request)
    {   
        $ticket = Ticket::where('ticket_id', $request['ticket_id'])->firstOrFail();
        $ticket->status = 'Closed';
        $ticket->save();

        Session::flash('status', "El ticket " . $request['ticket_id'] . " se ha cerrado.");
        return redirect()->intended('solicitudes/listarTickets');
    }

    public function atender(Request $request)
    {   
        $ticket = Ticket::where('ticket_id', $request['ticket_id'])->firstOrFail();
        $ticket->status = 'Pending';
        $ticket->save();

        Session::flash('status', "Ha finalizado la atención del ticket " . $request['ticket_id'] . " correctamente.");
        return redirect()->intended('solicitudes/listarTickets');
    }

    public function reabrir(Request $request)
    {   
        $ticket = Ticket::where('ticket_id', $request['ticket_id'])->firstOrFail();
        $ticket->status = 'Open';
        $ticket->save();

        Session::flash('status', "Ha realizado la reapertura del ticket " . $request['ticket_id'] . " correctamente.");
        return redirect()->intended('solicitudes/listarTickets');
    }

    public function descargar(Request $request){
        if(Storage::disk('local')->exists($request['filename']))
            return response()->download(storage_path("adjuntos/".$request['filename']));
    }
}
