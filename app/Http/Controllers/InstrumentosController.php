<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Position;
use App\Department;
use App\Instrumento;
use Session;
use Auth;

class InstrumentosController extends Controller
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
        $arr = ['department_id', 'position_id'];
        $instrumentos = Instrumento::select('department_id', 'position_id')->groupBy($arr)->get();
        return view('evaluaciones/instrumento/index', compact('instrumentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments    = Department::orderBy('name', 'asc')->get();
        $positions      = Position::orderBy('name', 'asc')->get();
        return view('evaluaciones/instrumento/create', compact('departments', 'positions'));
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
        
        Instrumento::create([
            'department_id' => $request['departamento_id'],
            'position_id'   => $request['cargo_id'],
            'descripcion'   => $request['instrumento'],
            'porcentaje'    => $request['porcentaje']
        ]);

        Session::flash('status', "Se ha registrado un nuevo instrumento.");

        return redirect()->intended('evaluaciones/instrumentos/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dimensiones($departamento, $cargo)
    {   
        $arr = [
            'department_id'    => $departamento,
            'position_id'       => $cargo
        ];

        $instrumentos   = Instrumento::where($arr)->get();
        $department     = Department::where('id', $departamento)->First();
        $position       = Position::where('id', $cargo)->First();
        return view('evaluaciones/instrumento/show', compact('department', 'position', 'instrumentos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $instrumento = Instrumento::where('id', $id)->First();
        // Redirect to position list if updating position wasn't existed
        if ($instrumento == null || count($instrumento) == 0) {
            return redirect()->intended('evaluaciones/instrumentos');
        }

        return view('evaluaciones/instrumento/edit', ['instrumento' => $instrumento]);
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
        $instrumento = Instrumento::findOrFail($id);

        $reglas = [
            'instrumento'       => 'required|string|max:150',
            'porcentaje'        => 'required|numeric|max:100|min:0'
        ];

        $mensajes = [
            'instrumento.required'      => 'El nombre del instrumento es requerido.',
            'instrumento.string'        => 'El nombre del instrumento debe ser un texto',
            'instrumento.max'           => 'El nombre del instrumento no debe exceder de 150 caracteres.',
            'porcentaje.required'       => 'El porcentaje del instrumento es requerido.',
            'porcentaje.numeric'        => 'El porcentaje debe estar expresado en números.',
            'porcentaje.max'            => 'El porcentaje máximo es de 100%',
            'porcentaje.min'            => 'El porcentaje mínimo es de 0%'
        ];

        $this->validate($request, $reglas, $mensajes);

        $input = [
            'descripcion'   => $request['instrumento'],
            'porcentaje'    => $request['porcentaje']
        ];

        Instrumento::where('id', $id)
            ->update($input);

        Session::flash('status', "Se ha modificado el instrumento exitosamente.");
        
        return redirect()->intended('evaluaciones/instrumentos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*Instrumento::where('id', $id)->delete();

        Session::flash('status', "Se ha eliminado el instrumento exitosamente.");

        return redirect()->intended('evaluaciones/instrumentos');*/

    }

    private function validateInput($request) {
        $reglas = [
            'departamento_id'   => 'required',
            'cargo_id'          => 'required',
            'instrumento'       => 'required|string|max:150',
            'porcentaje'        => 'required|numeric|max:100|min:0'
        ];

        $mensajes = [
            'departamento_id.required'  => 'El departamento asociado al instrumento es requerido.',
            'cargo_id.required'         => 'El cargo asociado al instrumento es requerido.',
            'instrumento.required'      => 'El nombre del instrumento es requerido.',
            'instrumento.string'        => 'El nombre del instrumento debe ser un texto',
            'instrumento.max'           => 'El nombre del instrumento no debe exceder de 150 caracteres.',
            'porcentaje.required'       => 'El porcentaje del instrumento es requerido.',
            'porcentaje.numeric'        => 'El porcentaje debe estar expresado en números.',
            'porcentaje.max'            => 'El porcentaje máximo es de 100%',
            'porcentaje.min'            => 'El porcentaje mínimo es de 0%'
        ];

        $this->validate($request, $reglas, $mensajes);
    }
}
