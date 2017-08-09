<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prima;
use App\Department;
use App\User;
use Session;

class PrimasController extends Controller
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
        return view('evaluaciones/prima/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $departamentos = Department::orderBy('name', 'ASC')->get();

        return view('evaluaciones/prima/create', compact('departamentos'));
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

     	Prima::create([
    	    'user_id'   => $request['user_id'],
            'cantidad'      => $request['prima']
        ]);

        $usuario = User::where('id', $request['user_id'])->First();
        $nombre = ucwords($usuario->primer_nombre . " " . $usuario->primer_apellido);

        Session::flash('status', "Se ha registrado una nueva prima para " . $nombre . ".");

        return redirect()->intended('evaluaciones/prima');
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
        $prima = Prima::find($id);
        $colaborador = User::where('id', $prima->user_id)->First();
        // Redirect to Bono list if updating Bono wasn't existed
        if ($prima == null || count($prima) == 0) {
            return redirect()->intended('/evaluaciones/prima');
        }

        return view('evaluaciones/prima/edit', compact('prima', 'colaborador'));
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
        $prima = Prima::findOrFail($id);
        
        $colaborador = User::where('id', $prima->user_id)->First();
        $nombre = ucwords($colaborador->primer_nombre . " " . $colaborador->primer_apellido);

        $reglas = [
            'prima'      => 'required|numeric',
        ];

        $mensajes = [
            'prima.required'         => 'La cantidad de la prima es requerida.',
            'prima.numeric'          => 'La cantidad de la prima debe ser numérica.',
        ];

        $this->validate($request, $reglas, $mensajes);
        
        $input = [            
            'cantidad'      => $request['prima']
        ];

        if ($prima == null || count($prima) == 0) {
            return redirect()->intended('/evaluaciones/prima');
        }

        $prima->update($input);                

        Session::flash('status', "Se ha actualizado la prima para  " . $nombre . ".");

        return redirect()->intended('evaluaciones/prima');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $prima = Prima::findOrFail($id);
        $colaborador = User::where('id', $prima->user_id)->First();
        $nombre = ucwords($colaborador->primer_nombre . " " . $colaborador->primer_apellido);

        $prima->delete();

        Session::flash('status', "Se ha eliminado la prima para " . $nombre . ".");

        return redirect()->intended('evaluaciones/prima');
    }

    private function validateInput($request) {
        $reglas = [
            'user_id'   => 'required',
            'prima'      => 'required|numeric',
        ];

        $mensajes = [
            'user_id.required'  => 'El cargo es requerido.',
            'prima.required'    => 'La cantidad del bono es requerida.',
            'prima.numeric'     => 'La cantidad del bono debe ser numérica.',
        ];

        $this->validate($request, $reglas, $mensajes);
    }
}
