<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\City;
use App\State;
use Session;

class CityController extends Controller
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
        return view('parametros/ciudades/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::all();
        return view('parametros/ciudades/create', ['states' => $states]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        State::findOrFail($request['state_id']);
        $this->validateInput($request);
        city::create([
            'name' => $request['name'],
            'state_id' => $request['state_id']
        ]);

        Session::flash('status', "Se ha registrado una nueva ciudad.");
        return redirect()->intended('parametros/ciudades');
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
        $city = city::find($id);
        // Redirect to city list if updating city wasn't existed
        if ($city == null || count($city) == 0) {
            return redirect()->intended('/parametros/ciudades');
        }

        $states = State::all();
        return view('parametros/ciudades/edit', ['city' => $city, 'states' => $states]);
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
        $city = City::findOrFail($id);
         $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        $input = [
            'name' => $request['name'],
            'state_id' => $request['state_id']
        ];
        City::where('id', $id)
            ->update($input);
        
        return redirect()->intended('parametros/ciudades');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        City::where('id', $id)->delete();
         return redirect()->intended('parametros/ciudades');
    }


    private function validateInput($request) {
        $reglas = ['name' => 'required|max:60|unique:city'];
        $mensajes = [
            'name.required'     => 'El nombre de la ciudad no puede estar vacío.',
            'name.max'       => 'El nombre de la ciudad no puede exceder de 60 caracteres.',
            'name.unique'  => 'El nombre de la ciudad no puede estar repetido.'
        ];
        $this->validate($request, $reglas, $mensajes);
    }
}
