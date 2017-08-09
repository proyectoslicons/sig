<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bono;
use App\Position;
use Session;

class BonosController extends Controller
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
        return view('evaluaciones/bono/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bonos_actuales = Bono::all();

        $arr = [];

        foreach ($bonos_actuales as $bono) {
            array_push($arr, $bono->position_id);
        }

        $positions = Position::whereNotIn('id', $arr)->get();

        return view('evaluaciones/bono/create', compact('positions'));
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

     	Bono::create([
    	    'position_id'   => $request['position_id'],
            'cantidad'      => $request['bono']
        ]);

        Session::flash('status', "Se ha registrado un nuevo bono.");

        return redirect()->intended('evaluaciones/bono');
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
        $bono = Bono::find($id);
        $cargo = Position::where('id', $bono->position_id)->First();
        // Redirect to Bono list if updating Bono wasn't existed
        if ($bono == null || count($bono) == 0) {
            return redirect()->intended('/evaluaciones/bono');
        }

        return view('evaluaciones/bono/edit', compact('bono', 'cargo'));
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
        $bono = Bono::findOrFail($id);
        
        $cargo = Position::where('id', $bono->position_id)->First();

        $reglas = [
            'bono'      => 'required|numeric',
        ];

        $mensajes = [
            'bono.required'         => 'La cantidad del bono es requerida.',
            'bono.numeric'          => 'La cantidad del bono debe ser numérica.',
        ];

        $this->validate($request, $reglas, $mensajes);
        
        $input = [            
            'cantidad'      => $request['bono']
        ];

        if ($bono == null || count($bono) == 0) {
            return redirect()->intended('/evaluaciones/bono');
        }

        $bono->update($input);                

        Session::flash('status', "Se ha actualizado el bono para el cargo " . ucwords($cargo->name) . ".");

        return redirect()->intended('evaluaciones/bono');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $bono = Bono::findOrFail($id);
        $cargo = Position::where('id', $bono->position_id)->First();

        $bono->delete();

        Session::flash('status', "Se ha eliminado el bono para el cargo " . ucwords($cargo->name) . ".");

        return redirect()->intended('evaluaciones/bono');
    }

    private function validateInput($request) {
        $reglas = [
            'position_id'   => 'required',
            'bono'      => 'required|numeric',
        ];

        $mensajes = [
            'position_id.required'  => 'El cargo es requerido.',
            'bono.required'         => 'La cantidad del bono es requerida.',
            'bono.numeric'          => 'La cantidad del bono debe ser numérica.',
        ];

        $this->validate($request, $reglas, $mensajes);
    }
}
