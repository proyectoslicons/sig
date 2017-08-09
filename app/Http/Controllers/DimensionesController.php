<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Position;
use App\Instrumento;
use App\Department;
use App\Dimension;
use Session;
use Auth;

class DimensionesController extends Controller
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
    public function index($id)
    {
        $instrumento    = Instrumento::where('id', $id)->First();
        $position       = Position::where('id', $instrumento->position_id)->First();
        $department     = Department::where('id', $instrumento->department_id)->First();
        $dimensiones    = Dimension::where('instrumento_id', $id)->get();
        return view('evaluaciones/dimension/index', compact('instrumento', 'position', 'department', 'dimensiones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('evaluaciones/dimension/create', compact('id'));
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
        Dimension::create([
            'instrumento_id'    => $request['instrumento_id'],
            'descripcion'       => $request['dimension'],
            'porcentaje'        => $request['porcentaje']
        ]);

        $instrumento = Instrumento::where('id', $request['instrumento_id'])->First();

        Session::flash('status', "Se ha registrado una nueva dimensión para el instrumento: " . $instrumento->descripcion . ".");

        return redirect()->route('listar_dimensiones', ['id' => $request['instrumento_id']]);
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
        $dimension          = Dimension::find($id);        
        $instrumento        = Instrumento::where('id', $dimension->instrumento_id)->First();
        $unidad_funcional   = Department::where('id', $instrumento->department_id)->First();
        $cargo              = Position::where('id', $instrumento->position_id)->First();
        // Redirect to position list if updating position wasn't existed
        if ($dimension == null || count($dimension) == 0) {
            return redirect()->intended('/parametros/cargos');
        }

        return view('evaluaciones/dimension/edit', compact('dimension', 'instrumento', 'unidad_funcional', 'cargo'));
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
        $dimension = Dimension::findOrFail($id);
        
        $reglas = [          
            'dimension'         => 'required|string|max:150',
            'porcentaje'        => 'required|numeric|max:100|min:0'
        ];

        $mensajes = [           
            'dimension.required'        => 'El nombre de la dimensión es requerido.',
            'dimension.string'          => 'El nombre de la dimensión debe ser un texto',
            'dimension.max'             => 'El nombre de la dimensión no debe exceder de 150 caracteres.',
            'porcentaje.required'       => 'El porcentaje del instrumento es requerido.',
            'porcentaje.numeric'        => 'El porcentaje debe estar expresado en números.',
            'porcentaje.max'            => 'El porcentaje máximo es de 100%',
            'porcentaje.min'            => 'El porcentaje mínimo es de 0%'
        ];

        $this->validate($request, $reglas, $mensajes);

        $input = [
            'descripcion'   => $request['dimension'],
            'porcentaje'    => $request['porcentaje']
        ];

        $dimension->update($input);

        $instrumento = Instrumento::where('id', $dimension->instrumento_id)->First();

        Session::flash(
            'status', 
            "Se ha modificado correctamente la dimensión: ". $dimension->descripcion 
            . ", para el instrumento: " . $instrumento->descripcion . "."
        );
        
        return redirect()->route('listar_dimensiones', ['id' => $instrumento->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dimension::where('id', $id)->delete();
        return redirect()->intended('evaluaciones/instrumentos');
    }

    private function validateInput($request) {
        $reglas = [
            'instrumento_id'    => 'required',            
            'dimension'         => 'required|string|max:150',
            'porcentaje'        => 'required|numeric|max:100|min:0'
        ];

        $mensajes = [
            'instrumento_id.required'   => 'El instrumento asociado a la dimensión es requerido.',            
            'dimension.required'        => 'El nombre de la dimensión es requerido.',
            'dimension.string'          => 'El nombre de la dimensión debe ser un texto',
            'dimension.max'             => 'El nombre de la dimensión no debe exceder de 150 caracteres.',
            'porcentaje.required'       => 'El porcentaje del instrumento es requerido.',
            'porcentaje.numeric'        => 'El porcentaje debe estar expresado en números.',
            'porcentaje.max'            => 'El porcentaje máximo es de 100%',
            'porcentaje.min'            => 'El porcentaje mínimo es de 0%'
        ];

        $this->validate($request, $reglas, $mensajes);
    }
}
