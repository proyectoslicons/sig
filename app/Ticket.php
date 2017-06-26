<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable = [
    'user_id', 'user_default_id', 'user_assigned_id', 'category_id', 'department_id',  'ticket_id', 'title', 'priority', 'fecha_atencion', 'type', 'message', 'status'
	];	

	public function categories(){
	    return $this->belongsTo(Categories::class);
	}

	public function comments(){
	    return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
	}
	
	public function user(){
	    return $this->belongsTo(User::class);
	}

	public function department(){
	    return $this->belongsTo(Department::class);
	}
}
