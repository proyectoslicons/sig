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
use App\Ticket_Notification;
use App\Attachment;
use App\Position;
use App\Comment;
use DB;
use Storage;

class TicketController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

    public function index(){	   
	    
	    $departments = Department::orderBy('name', 'asc')->get();
        $primer_departamento = Department::orderBy('name', 'asc')->First();
        $categories = Categories::where('department_id', $primer_departamento->id)->orderBy('name', 'asc')->get();

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
        
        $id_encargado  = Department::where('id', $request['department'])->First()->id_department_head; 		
        
        $request->request->add(['encargado' => $id_encargado]);

	    $this->validate($request, $reglas, $mensajes);        

	    array_except($request->all(), ['encargado']);
    		
        $department = Department::where('id', Auth::user()->departamento_id)->get();

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

        $encargado = User::where('id', $id_encargado)->First();

        $mensaje = "El ticket se ha enviado a: ";

        $bitacora = new TicketBitacora([
            'user_id'   => $id_encargado,
            'ticket_id' => $ticket->ticket_id,
            'mensaje'   => $mensaje,
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

        $mensaje = "ha creado un nuevo ticket.";

        User::find($id_encargado)->notify(new \App\Notifications\NewTicket($id_encargado, Auth::user(), $ticket->ticket_id, $mensaje));

        return redirect()->back()->with("status", "Se ha abierto un nuevo ticket con el código: " . $ticket->ticket_id);
	}

	public function show($ticket_id){
	    $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

	    $comments = $ticket->comments;
	    
        $category = Categories::where('id', $ticket->category_id)->firstOrFail();
        
        $arr = [
            ['id', 'NOT LIKE', Auth::id()],
            ['is_active', '=', '1']
        ];

        $empleados = User::where('departamento_id', $ticket->department_id)
                    ->where($arr)
                    ->get();
        
        $bitacora = TicketBitacora::where('ticket_id', $ticket_id)->get();
        
        $users = \App\User::all();
        
        $departments = \App\Department::where('id', "NOT LIKE", $ticket->department_id)->get();

        $arr = [
            'ticket_id' => $ticket_id,
            'user_id'   => Auth::id(),
            'status'    => 0
        ];
        
        $notificaciones = Ticket_Notification::where($arr)->get();

        foreach ($notificaciones as $notificacion) {            
            $input = ['status' => 1];
            Ticket_Notification::where('ticket_id', $ticket_id)->update($input);                 
        }

        $comentarios_notificados = \App\CommentNotification::where($arr)->get();

        foreach ($comentarios_notificados as $comentario) {            
            $input = ['status' => 1];
            \App\CommentNotification::where('ticket_id', $ticket_id)->update($input);                 
        }

        $attachments = Attachment::where('ticket_id', $ticket_id)->get();      

	    return view('solicitudes.show', compact('comments', 'category', 'ticket', 'empleados', 'bitacora', 'users', 'departments', 'attachments'));
	}

    public function delegar(Request $request){
        $input = ['user_assigned_id' => $request['id_asignar']];

        $encargado = User::where('id', $request['id_asignar'])->First();

        $mensaje = "El ticket se ha delegado a: ";

        $bitacora = new TicketBitacora([
            'user_id'   => $request['id_asignar'],
            'ticket_id' => $request['ticket_id'],
            'mensaje'   => $mensaje,
        ]);

        $bitacora->save();

        $mensaje = "te ha delegado la atención de un ticket.";

        User::find($request['id_asignar'])->notify(new \App\Notifications\NewTicket($request['id_asignar'], Auth::user(), $request['ticket_id'], $mensaje));

        \App\Ticket::where('ticket_id', $request['ticket_id'])->update($input);
        $encargado = User::find($request['id_asignar']);
        $nombre = ucwords($encargado->primer_nombre . " " . $encargado->primer_apellido);
        return redirect()->back()->with("status", "Se ha delegado el ticket a: " . $nombre);
    }

    public function escalar(Request $request){
        $departamento = Department::where('id', $request['departamento_id'])->First();
        $id_encargado  = Department::where('id', $request['departamento_id'])->First()->id_department_head;

        $input = [
            'user_default_id'   => $id_encargado, 
            'user_assigned_id'  => $id_encargado,
            'department_id'     => $request['departamento_id']
        ];

        $encargado = User::where('id', $id_encargado)->First();

        $mensaje = "El ticket se ha escalado a la unidad funcional: " . ucwords($departamento->name) . ", a cargo de: ";

        $files = $request->file('archivos');
        $i = 0;

        if(count($files) > 0 ){
            foreach ($files as $file) {
                $request->request->add(['archivo'.$i => $file]); 
                $reglas['archivo'.$i] = 'mimes:jpeg,png,doc,docx,xls,xlsx,ppt,pptx,pdf';
                $mensajes['archivo'.$i.'.mimes'] = 'Sólo se aceptan formatos jpeg, png, doc, docx, xls, xlsx, ppt, pptx, pdf.';   
                $i++;             
            }

            $this->validate($request, $reglas, $mensajes);

            $files = $request->file('archivos');

            foreach ($files as $file) {
                $nombre_archivo = $request['ticket_id']. "_" . $file->getClientOriginalName();
                $file->storeAs('', $nombre_archivo);
                $adjunto = new Attachment([
                    'ticket_id' => $request['ticket_id'],
                    'user_id'   => Auth::user()->id,
                    'filename'  => $nombre_archivo
                ]);
                $adjunto->save();
            }
        }

        if($request['mensaje_escalar'] !== null){                        
            User::find($id_encargado)
            ->notify(new \App\Notifications\TicketCommented($id_encargado, Auth::user(), $request['ticket_id']));
            
            $ticket = Ticket::where('ticket_id', $request['ticket_id'])->First();

            $comment = Comment::create([
                'ticket_id' => $ticket->id,
                'user_id'   => Auth::user()->id,
                'comment'   => $request['mensaje_escalar'],
            ]);
        } 

        $bitacora = new TicketBitacora([
            'user_id'   => $id_encargado,
            'ticket_id' => $request['ticket_id'],
            'mensaje'   => $mensaje,            
        ]);

        $bitacora->save();

        $mensaje = "ha escalado un ticket.";

        User::find($id_encargado)->notify(new \App\Notifications\NewTicket($id_encargado, Auth::user(), $request['ticket_id'], $mensaje));

        \App\Ticket::where('ticket_id', $request['ticket_id'])->update($input);
        
        $departamento = \App\Department::find($request['departamento_id']); 

        Session::flash('status', "Se ha escalado el ticket " . $request['ticket_id'] . " a la unidad funcional: " . $departamento->name);
        return redirect()->intended('solicitudes/listarTickets');

    }

    public function close(Request $request)
    {   
        $ticket = Ticket::where('ticket_id', $request['ticket_id'])->firstOrFail();
        if($ticket->user_id === Auth::id()){
            $ticket->status = 'Closed';
            $ticket->save();

            $mensaje = "El ticket ha sido cerrado por:";

            $bitacora = new TicketBitacora([
                'user_id'   => Auth::id(),
                'ticket_id' => $request['ticket_id'],
                'mensaje'   => $mensaje,            
            ]);

            $bitacora->save();

            $mensaje = "ha cerrado el ticket";

            User::find($ticket->user_default_id)->notify(new \App\Notifications\NewTicket($ticket->user_default_id, Auth::user(), $ticket->ticket_id, $mensaje));

            User::find($ticket->user_assigned_id)->notify(new \App\Notifications\NewTicket($ticket->user_assigned_id, Auth::user(), $ticket->ticket_id, $mensaje));

            Session::flash('status', "El ticket " . $request['ticket_id'] . " se ha cerrado.");
            return redirect()->intended('solicitudes/listarTickets');
        }
        else{
            return redirect()->intended('/home');
        }
    }

    public function atender(Request $request)
    {   
        $ticket = Ticket::where('ticket_id', $request['ticket_id'])->firstOrFail();
        $ticket->status = 'Pending';
        $ticket->save();

        $mensaje = "ha finalizado la atención del ticket:";

        $bitacora = new TicketBitacora([
            'user_id'   => Auth::id(),
            'ticket_id' => $request['ticket_id'],
            'mensaje'   => $mensaje,            
        ]);

        $bitacora->save();

        User::find($ticket->user_id)->notify(new \App\Notifications\NewTicket($ticket->user_id, Auth::user(), $ticket->ticket_id, $mensaje));

        Session::flash('status', "Ha finalizado la atención del ticket " . $request['ticket_id'] . " correctamente.");
        return redirect()->intended('solicitudes/listarTickets');
    }

    public function reabrir(Request $request)
    {   
        $ticket = Ticket::where('ticket_id', $request['ticket_id'])->firstOrFail();
        $ticket->status = 'Open';
        $ticket->save();

        $mensaje = "ha realizado la reapertura del ticket";

        $bitacora = new TicketBitacora([
            'user_id'   => Auth::id(),
            'ticket_id' => $request['ticket_id'],
            'mensaje'   => $mensaje,            
        ]);

        $bitacora->save();

        User::find($ticket->user_default_id)->notify(new \App\Notifications\NewTicket($ticket->user_default_id, Auth::user(), $ticket->ticket_id, $mensaje));

        User::find($ticket->user_assigned_id)->notify(new \App\Notifications\NewTicket($ticket->user_assigned_id, Auth::user(), $ticket->ticket_id, $mensaje));

        Session::flash('status', "Ha realizado la reapertura del ticket " . $request['ticket_id'] . " correctamente.");
        return redirect()->intended('solicitudes/listarTickets');
    }

    public function descargar(Request $request){
        if(Storage::disk('local')->exists($request['filename']))
            return response()->download(storage_path("adjuntos/".$request['filename']));
    }
}
