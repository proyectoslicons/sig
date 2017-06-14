<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\department;
use Session;
use Auth;

class DepartmentController extends Controller
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
        return view('parametros/unidades/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parametros/unidades/create');
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
         Department::create([
            'name'      => $request['name'],
            'iniciales' => $request['iniciales'],
        ]);

        Session::flash('status', "Se ha registrado una nueva unidad funcional.");
        return redirect()->intended('parametros/unidades');
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
        $department = Department::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($department == null || count($department) == 0) {
            return redirect()->intended('/parametros/unidades');
        }

        return view('parametros/unidades/edit', ['department' => $department]);
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
        $department = Department::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name'],
            'iniciales' => $request['iniciales'],
        ];
        Department::where('id', $id)
            ->update($input);
        
        return redirect()->intended('parametros/unidades');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::where('id', $id)->delete();
         return redirect()->intended('parametros/unidades');
    }

    private function validateInput($request) {
        $this->validate($request, [
        'name'          => 'required|max:60|unique:department',
        'iniciales'     => 'required|max:3|unique:department',
    ]);
    }
}
