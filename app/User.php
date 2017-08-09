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
        'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'cedula', 'rif', 'fecha_nacimiento', 'edad', 'sexo', 'fecha_ingreso', 'direccion', 'telefono_habitacion', 'telefono_movil', 'telefono_corporativo', 'extension', 'profesion_id', 'departamento_id', 'cargo_id', 'sueldo', 'cargas', 'estado_civil', 'lugar_nacimiento', 'fecha_egreso', 'email_personal', 'email', 'password', 'is_admin', 'is_auditor', 'is_active', 'imagen'
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
