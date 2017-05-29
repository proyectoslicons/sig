<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Country;
use Session;

class CountryController extends Controller
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
        return view('parametros/paises/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parametros/paises/create');
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
         Country::create([
            'name' => $request['name']
        ]);

        Session::flash('status', "Se ha registrado un nuevo país.");
        return redirect()->intended('parametros/paises');
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
        $country = Country::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($country == null || count($country) == 0) {
            return redirect()->intended('/parametros/paises');
        }

        return view('parametros/paises/edit', ['country' => $country]);
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
        $country = Country::findOrFail($id);
        $input = [
            'name' => $request['name']
        ];
        $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        Country::where('id', $id)
            ->update($input);
        
        return redirect()->intended('parametros/paises');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::where('id', $id)->delete();
         return redirect()->intended('parametros/paises');
    }

    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60|unique:country'
    ]);
    }
}
