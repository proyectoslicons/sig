<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'cedula', 'fecha_nacimiento', 'fecha_ingreso', 'direccion', 'telefono_habitacion', 'telefono_movil', 'extension', 'profesion', 'departamento_id', 'cargo_id', 'sueldo', 'cargas', 'pareja', 'hijos', 'estado_civil', 'lugar_nacimiento', 'fecha_egreso', 'email', 'password', 'is_admin', 'is_coordinator', 'is_auditor', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
