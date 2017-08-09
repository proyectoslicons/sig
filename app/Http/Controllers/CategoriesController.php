<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Categories;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departamento_usuario = \App\Department::where('id', Auth::user()->departamento_id)->First();
        if(Auth::user()->is_admin || Auth::user()->id == $departamento_usuario->id_department_head){
            if(Auth::user()->is_admin){
                $categorias = Categories::all();
                return view('categorias_tickets/index', compact('categorias'));
            }
            else{
                $categorias = Categories::where('department_id', Auth::user()->departamento_id)->get();
                return view('categorias_tickets/index', compact('categorias'));    
            }
        }
        else{
            return redirect()->intended('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $departamento_usuario = \App\Department::where('id', Auth::user()->departamento_id)->First();
        if(Auth::user()->is_admin || Auth::user()->id == $departamento_usuario->id_department_head){
            $departments = \App\Department::orderBy('name', 'asc')->get();;
            return view('categorias_tickets/create', compact('departments'));
        }
        else{
            return redirect()->intended('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->validateInput($request);
        \App\Categories::create([
            'name'          => $request['name'],
            'department_id' => $request['department'],
        ]);

        Session::flash('status', "Se ha registrado una nueva categoría.");

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = \App\Categories::find($id);
        // Redirect to position list if updating position wasn't existed
        if ($category == null || count($category) == 0) {
            return redirect()->intended('/categorias_tickets');
        }

        return view('categorias_tickets/edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = \App\Categories::findOrFail($id);
        
        $reglas = [
            'name'          => 'required|max:150',            
        ];

        $mensajes = [
            'name.required'         => 'El nombre de la categoría es requerido',
            'name.max'              => 'Tamaño máximo del nombre: 60 caracteres',            
        ];

        $this->validate($request, $reglas, $mensajes);

        $input = [
            'name' => $request['name']
        ];
        
        \App\Categories::where('id', $id)->update($input);

        Session::flash('status', "Se ha modificado exitosamente la categoría.");
        
        return redirect()->intended('solicitudes/categorias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Categories::where('id', $id)->delete();
        return redirect()->intended('solicitudes/categorias');
    }

    private function validateInput($request) {
        $reglas = [
            'name'          => 'required|max:150',
            'department'    => 'required|numeric'
        ];

        $mensajes = [
            'name.required'         => 'El nombre de la categoría es requerido',
            'name.max'              => 'Tamaño máximo del nombre: 60 caracteres',
            'department.required'   => 'El departamento asociado a la categoría es requerido',
            'department.numeric'    => 'Error en los datos del departamento asociado, contacte al administrador',
        ];

        $this->validate($request, $reglas, $mensajes);
    }
}
