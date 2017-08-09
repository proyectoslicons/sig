<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use Session;

class EncargadoController extends Controller
{   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $departamentos = Department::orderBy('name', 'asc')->get();
        return view('parametros/encargado_unidad/index', compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $departamentos = Department::orderBy('name', 'asc')->get();
        return view('parametros/encargado_unidad/create', compact('departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $departamento   = Department::findOrFail($request['department_id']);
        $empleado       = User::findOrFail($request['colaborador_id']);

        if(count($departamento) > 0 && count($empleado) > 0){
            $input['id_department_head'] = $request['colaborador_id'];
            Department::where('id', $request['department_id'])->update($input);

            $nombre = ucwords($empleado->primer_nombre . " " . $empleado->primer_apellido);

            Session::flash('status', "Se ha asignado correctamente a ". $nombre ." como encargado de la unidad funcional ". ucwords($departamento->name) .".");
            return redirect()->intended('parametros/encargado');
        }
        else{
            return redictect()->back()->withErrors(['No es posible asignar el encargado a la unidad funcional.']);            
        }        
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
        $department_head = User::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($department_head == null || count($department_head) == 0) {
            return redirect()->intended('/parametros/encargado_unidad');
        }

        $department = Department::find($department_head->departamento_id);

        return view('parametros/encargado_unidad/edit', compact('department_head', 'department'));
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
        $encargado_unidad = User::findOrFail($id);
        $input['id_department_head'] = $id;

        Department::where('id', $id)
            ->update($input);

        Session::flash('status', "Se ha asignado correctamente a ". $nombre ." como encargado de la unidad funcional ". ucwords($request['department']) .".");
        
        return redirect()->intended('parametros/encargado_unidad');
    }

    public function change(Request $request)
    {
        $encargado_unidad = User::findOrFail($request['colaborador_id']);
        $input['id_department_head'] = $request['colaborador_id'];       

        $nombre = ucwords($encargado_unidad->primer_nombre . " " . $encargado_unidad->primer_apellido);        

        Department::where('id', $request['department_id'])
                    ->update($input);

        $departamento = Department::where('id', $request['department_id'])->First();
        Session::flash('status', "Se ha asignado correctamente a ". $nombre ." como encargado de la unidad funcional ". ucwords($departamento->name) . ".");
        
        return redirect()->intended('parametros/encargado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
