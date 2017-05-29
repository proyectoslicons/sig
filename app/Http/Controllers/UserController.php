<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class UserController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
        protected $redirectTo = '/usuarios';

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
        return view('usuarios/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios/create');
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

         \App\User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),            
        ]);

        Session::flash('status', "Se ha registrado un nuevo usuario.");

        return redirect()->intended('/usuarios');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::find($id);
        // Redirect to user list if updating user wasn't existed
        if ($user == null || count($user) == 0) {
            return redirect()->intended('/usuarios');
        }

        return view('usuarios/edit', ['user' => $user]);
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
        $user = \App\User::findOrFail($id);
        
        $constraints = [
            'name' => 'required|max:60',            
        ];
        
        if($request['email'] != $user->email)
            $constraints['email'] = 'required|email|max:255|unique:users';

        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
        ];

        if ($request['password'] != null && strlen($request['password']) > 0) {
            $constraints['password'] = 'required|min:6|confirmed';
            $input['password'] =  bcrypt($request['password']);            
        }

        $this->validate($request, $constraints);

        \App\User::where('id', $id)
            ->update($input);
        
        return redirect()->intended('/usuarios');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\User::where('id', $id)->delete();
         return redirect()->intended('/usuarios');
    }


    private function validateInput($request) {
        $this->validate($request, [
            'name' => 'required|max:60',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);
    }
}
