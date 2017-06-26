<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\Comment;
use App\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //
    public function postComment(Request $request){
    	$reglas = [
    		'comment'   => 'required',
    	];

    	$mensajes = [
    		'comment.required'	=> "El texto del comentario es requerido.",	
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

	    $this->validate($request, $reglas, $mensajes);

        $comment = Comment::create([
            'ticket_id' => $request->input('ticket_id'),
            'user_id'   => Auth::user()->id,
            'comment'   => $request->input('comment'),
        ]);

        $files = $request->file('archivos');        

        if(count($files) > 0)
        foreach ($files as $file) {
            $nombre_archivo = $request->input('ticket'). "_" . $file->getClientOriginalName();
            $file->storeAs('', $nombre_archivo);
            $adjunto = new Attachment([
                'ticket_id' => $request->input('ticket'),
                'user_id'   => Auth::user()->id,
                'filename'  => $nombre_archivo
            ]);
            $adjunto->save();
        }
	       
    	return redirect()->back()->with("status", "Se ha enviado su comentario.");
	}
}
