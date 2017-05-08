<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\State;
use App\Country;

class StateController extends Controller
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
         
        return view('parametros/estados/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('parametros/estados/create', ['countries' => $countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Country::findOrFail($request['country_id']);
        $this->validateInput($request);
         State::create([
            'name' => $request['name'],
            'country_id' => $request['country_id']
        ]);

        return redirect()->intended('parametros/estados');
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
        $state = State::find($id);
        // Redirect to state list if updating state wasn't existed
        if ($state == null || count($state) == 0) {
            return redirect()->intended('/parametros/estados');
        }

        $countries = Country::all();
        return view('parametros/estados/edit', ['state' => $state, 'countries' => $countries]);
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
        $state = State::findOrFail($id);
         $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        $input = [
            'name' => $request['name'],
            'country_id' => $request['country_id']
        ];
        State::where('id', $id)
            ->update($input);
        
        return redirect()->intended('parametros/estados');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        State::where('id', $id)->delete();
         return redirect()->intended('parametros/estados');
    }

    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60|unique:state'
    ]);
    }
}
