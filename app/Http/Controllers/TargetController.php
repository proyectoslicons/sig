<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\TargetMinimo;
use App\Target;

class TargetController extends Controller
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
        return view('evaluaciones/target/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('evaluaciones/target/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas = [
            'target'      => 'required|numeric',
        ];

        $mensajes = [
            'target.required'         => 'El porcentaje del target es requerido.',
            'target.numeric'          => 'El porcentaje del target debe ser numérico.',
        ];

        $this->validate($request, $reglas, $mensajes);

        Target::create([
            'porcentaje' => $request['target']
        ]);

        Session::flash('status', "Se ha registrado un nuevo target.");

        return redirect()->intended('evaluaciones/target');
    }

    public function storeMinimo(Request $request)
    {   
        $reglas = [
            'target'      => 'required|numeric',
        ];

        $mensajes = [
            'target.required'         => 'El porcentaje del target es requerido.',
            'target.numeric'          => 'El porcentaje del target debe ser numérico.',
        ];

        $this->validate($request, $reglas, $mensajes);

        TargetMinimo::create([
            'porcentaje' => $request['target']
        ]);

        Session::flash('status', "Se ha registrado un nuevo target mínimo.");

        return redirect()->intended('evaluaciones/target');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('evaluaciones/target/minimo');
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

        return view('evaluaciones/target/edit', compact('bono', 'cargo'));
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

        return redirect()->intended('evaluaciones/target');
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

        return redirect()->intended('evaluaciones/target');
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
