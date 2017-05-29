<?php

namespace App\Http\Controllers;

use App\User;
use App\Ticket;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //
    public function postComment(Request $request){
	    $this->validate($request, [
	        'comment'   => 'required'
	    ]);

	        $comment = Comment::create([
	            'ticket_id' => $request->input('ticket_id'),
	            'user_id'   => Auth::user()->id,
	            'comment'   => $request->input('comment'),
	        ]);

	       
	        return redirect()->back()->with("status", "Se ha enviado su comentario.");
	}
}
