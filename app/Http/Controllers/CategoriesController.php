<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categorias_tickets/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias_tickets/create');
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
        \App\Categories::create([
            'name' => $request['name']
        ]);

        Session::flash('status', "Se ha registrado una nueva categoría.");

        return redirect()->intended('solicitudes/categorias');
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
        $category = \App\Categories::find($id);
        // Redirect to position list if updating position wasn't existed
        if ($category == null || count($category) == 0) {
            return redirect()->intended('/categorias_tickets');
        }

        return view('categorias_tickets/edit', ['category' => $category]);
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
        $category = \App\Categories::findOrFail($id);
        $this->validateInput($request);
        $input = [
            'name' => $request['name']
        ];
        \App\Categories::where('id', $id)
            ->update($input);
        
        return redirect()->intended('solicitudes/categorias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Categories::where('id', $id)->delete();
        return redirect()->intended('solicitudes/categorias');
    }

    private function validateInput($request) {
        $this->validate($request, [
            'name' => 'required|max:60|unique:category'
        ]);
    }
}
