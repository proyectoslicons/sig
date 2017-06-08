<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Occupation;
use Session;

class OccupationController extends Controller
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
        return view('parametros/profesiones/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parametros/profesiones/create');
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
         Occupation::create([
            'name' => $request['name']
        ]);

        Session::flash('status', "Se ha registrado una nueva profesión.");
        return redirect()->intended('parametros/profesiones');
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
        $occupation = Occupation::find($id);
        // Redirect to country list if updating country wasn't existed
        if ($occupation == null || count($occupation) == 0) {
            return redirect()->intended('/parametros/profesiones');
        }

        return view('parametros/profesiones/edit', ['occupation' => $occupation]);
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
        $occupation = Occupation::findOrFail($id);
        $input = [
            'name' => $request['name']
        ];
        $this->validate($request, [
        'name' => 'required|max:60'
        ]);
        Occupation::where('id', $id)
            ->update($input);
        
        return redirect()->intended('parametros/profesiones');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Occupation::where('id', $id)->delete();
         return redirect()->intended('parametros/profesiones');
    }

    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60|unique:occupation'
    ]);
    }
}
