<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use App\User;
use App\Categories;


class apiController extends Controller
{
    public function getUsers()
    {
        return Datatables::eloquent(User::query())->make(true);
    }

    public function getUsers2()
    {
        return User::get(['id', 'primer_nombre', 'primer_apellido', 'departamento_id', 'is_active']);
    }

    public function contactos(Request $request){
        $arr = [
            ['primer_apellido', 'LIKE', $request['letra'].'%'],
            ['is_active', '=', 1],
            ['departamento_id', 'NOT LIKE', 9]

        ];    	

    	$contactos = User::where($arr)->orderBy('primer_apellido', 'ASC')->orderBy('primer_nombre', 'ASC')->get(['id', 'primer_nombre', 'primer_apellido', 'departamento_id', 'cargo_id', 'telefono_movil', 'telefono_corporativo', 'extension', 'email', 'imagen']); 

    	return response($contactos);
    }

    public function buscarContacto(Request $request){
        $arr = [
            ['primer_apellido', 'LIKE', '%'.$request['cadena'].'%'],
            ['is_active', '=', 1]
        ];      

        $arr2 = [
            ['primer_nombre', 'LIKE', '%'.$request['cadena'].'%'],
            ['is_active', '=', 1]
        ];

        $contactos = User::where($arr)->orwhere($arr2)->orderBy('primer_apellido', 'ASC')->orderBy('primer_nombre', 'ASC')->get(['id', 'primer_nombre', 'primer_apellido', 'departamento_id', 'cargo_id', 'telefono_movil', 'telefono_corporativo', 'extension', 'email', 'imagen']); 
            
        return response($contactos);
    }

    public function buscarCategorias(Request $request){
        $categorias = Categories::where('department_id', $request['department_id'])->orderBy('name')->get(['id', 'name']);
        return response($categorias);
    }
}
