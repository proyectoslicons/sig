<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Session;
use Image;
use App\Department;
use App\Position;
use App\State;
use App\City;
use App\Occupation;
use App\User;
use Auth;
use Hash;

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
        if(Auth::user()->is_admin || Auth::user()->departamento_id === 3){
            return view('usuarios/index');
        }
        else{
            return redirect()->intended('/home');
        }
    }


    public function change()
    {
        return view('usuarios/changePassword');   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::orderBy('name', 'asc')->get();
        $positions = Position::orderBy('name', 'asc')->get();
        $states = State::orderBy('name', 'asc')->get();
        $occupations = Occupation::orderBy('name', 'asc')->get();

        if(Auth::user()->is_admin || Auth::user()->departamento_id == 3){
            return view('usuarios/create', compact('departments', 'positions', 'occupations', 'states'));
        }
        else{
            return redirect()->intended('/home');
        }        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        if(!isset($request['password'])){
            $request->request->add(['password' => '123456']);
            $request->request->add(['password_confirmation' => '123456']);
        }
        
        $this->validateInput($request);

        if ($request->hasFile('foto')){
            $imageName =    $request['tipo']."-".$request['cedula'] . 
                            $request['primer_nombre'] . 
                            " " . $request['primer_apellido'] . 
                            '.' . $request->file('foto')->getClientOriginalExtension();            

            $arr1 = ['á', 'é', 'í', 'ó', 'ú', 'ñ'];
            $arr2 = ['a', 'e', 'i', 'o', 'u', 'n'];

            $imageName = str_replace($arr1, $arr2, $imageName);

            $image = $request->file('foto');
            $path = public_path('images/' . $imageName);
            
            Image::make($image->getRealPath())->resize(152, 152)->save($path);
        }

        unset($request['foto']);

         \App\User::create([
            'primer_nombre'         => $request['primer_nombre'], 
            'segundo_nombre'        => $request['segundo_nombre'], 
            'primer_apellido'       => $request['primer_apellido'], 
            'segundo_apellido'      => $request['segundo_apellido'], 
            'cedula'                => $request['tipo']."-".$request['cedula'],
            'rif'                   => $request['rif'], 
            'fecha_nacimiento'      => $request['fecha_nacimiento'],
            'edad'                  => $request['edad'],
            'sexo'                  => $request['sexo'], 
            'fecha_ingreso'         => $request['fecha_ingreso'],
            'direccion'             => $request['direccion'], 
            'telefono_habitacion'   => $request['telefono_habitacion'], 
            'telefono_movil'        => $request['telefono_movil'], 
            'telefono_corporativo'  => $request['telefono_corporativo'], 
            'extension'             => $request['extension'], 
            'profesion_id'          => $request['profesion_id'], 
            'departamento_id'       => $request['departamento_id'], 
            'cargo_id'              => $request['cargo_id'], 
            'sueldo'                => $request['sueldo'], 
            'cargas'                => $request['cargas'], 
            'estado_civil'          => $request['estado_civil'], 
            'lugar_nacimiento'      => $request['lugar_nacimiento'],
            'fecha_egreso'          => $request['fecha_egreso'],
            'email_personal'        => $request['email_personal'],
            'email'                 => $request['email'],
            'password'              => bcrypt($request['password']),
            'is_active'             => $request['estatus'],
            'imagen'                => $imageName             
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

        $departments = Department::orderBy('name', 'asc')->get();
        $positions = Position::orderBy('name', 'asc')->get();
        $states = State::orderBy('name', 'asc')->get();
        $occupations = Occupation::orderBy('name', 'asc')->get();

        if(Auth::user()->is_admin || Auth::user()->departamento_id === 3){
            return view('usuarios/edit', compact('user', 'departments', 'positions', 'states', 'occupations'));
        }
        else{
            return redirect()->intended('/home');
        }        
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
        $user = User::findOrFail($id);

        $constraints = [
            'primer_nombre'         => 'required|max:20|string', 
            'segundo_nombre'        => 'nullable|max:20|string', 
            'primer_apellido'       => 'required|max:20|string', 
            'segundo_apellido'      => 'nullable|max:20|string', 
            'cedula'                => 'required|max:8',
            'rif'                   => 'required|max:12', 
            'fecha_nacimiento'      => 'required|date', 
            'edad'                  => 'required|numeric',
            'sexo'                  => 'required|alpha',
            'fecha_ingreso'         => 'required|date',
            'direccion'             => 'required|max:200', 
            'telefono_habitacion'   => 'required', 
            'telefono_movil'        => 'required',
            'telefono_corporativo'  => 'nullable', 
            'extension'             => 'nullable|numeric', 
            'profesion_id'          => 'required|numeric', 
            'departamento_id'       => 'required|numeric', 
            'cargo_id'              => 'required|numeric', 
            'sueldo'                => 'required', 
            'cargas'                => 'required|numeric', 
            'estado_civil'          => 'required|alpha', 
            'lugar_nacimiento'      => 'required|max:200',
        ];        

        $mensajes = [
            'primer_nombre.required'        => 'El primer nombre no puede estar vacío.', 
            'primer_nombre.max'             => 'Primer nombre: Máximo 20 caracteres por nombre.',
            'primer_nombre.string'           => 'Primer nombre: Sólo se permiten caracteres alfabéticos.',
            'segundo_nombre.max'            => 'Segundo nombre: Máximo 20 caracteres por nombre.',
            'segundo_nombre.string'          => 'Segundo nombre: Sólo se permiten caracteres alfabéticos.',
            'primer_apellido.required'      => 'El primer apellido no puede estar vacío.', 
            'primer_apellido.max'           => 'Primer apellido: Máximo 20 caracteres por apellido.',
            'primer_apellido.string'         => 'Primer apellido: Sólo se permiten caracteres alfabéticos.',
            'segundo_apellido.max'          => 'Segundo apellido: Máximo 20 caracteres por apellido.',
            'segundo_apellido.string'        => 'Segundo apellido: Sólo se permiten caracteres alfabéticos.',
            'cedula.required'               => 'La cédula no puede estar vacía',
            'cedula.max'                    => 'Cédula: Máximo 8 caracteres.',
            'rif.required'                  => 'El RIF no puede estar vacío',
            'rif.max'                       => 'RIF: Máximo 12 caracteres.',
            'fecha_nacimiento.required'     => 'La fecha de nacimiento no puede estar vacía.',
            'fecha_nacimiento.date'         => 'Fecha de nacimiento: el formato de la fecha no es válido.',
            'edad.required'                 => 'La edad no pueden estar vacía.',
            'edad.numeric'                  => 'La edad debe ser un valor numérico.', 
            'sexo.required'                 => 'El campo de sexo no puede estar vacío.',
            'sexo.alpha'                    => 'Sexo: sólo se permiten caracteres alfabéticos.',
            'fecha_ingreso.required'        => 'La fecha de ingreso no puede estar vacía.',
            'fecha_ingreso.date'            => 'Fecha de ingreso: el formato de la fecha no es válido.', 
            'direccion.required'            => 'La dirección no puede estar vacía.', 
            'direccion.max'                 => 'Dirección: Máximo 200 caracteres.',
            'telefono_habitacion.required'  => 'El teléfono de habitación no puede estar vacío',
            'telefono_movil.required'       => 'El teléfono móvil no puede estar vacío',
            'extension.numeric'             => 'La extensión sólo puede ser numérica.',
            'profesion_id.required'         => 'La profesión no puede estar vacía.', 
            'profesion_id.numeric'          => 'La profesión sólo puede ser un valor numérico.',
            'departamento_id.required'      => 'El departamento es requerido.',
            'departamento_id.numeric'       => 'El departamento sólo puede ser un valor numérico.',
            'cargo_id.required'             => 'El cargo es requerido.',
            'cargo_id.numeric'              => 'El cargo sólo puede ser un valor numérico.',
            'sueldo.required'               => 'El sueldo no puede estar vacío.',
            'cargas.required'               => 'Las cargas familiares no pueden estar vacías.',
            'cargas.numeric'                => 'Las cargas familiares deben ser un valor numérico.',
            'estado_civil.required'         => 'El campo de hijos no puede estar vacío.',
            'estado_civil.alpha'            => 'Estado civil: sólo se permiten caracteres alfabéticos.',
            'lugar_nacimiento.required'     => 'El lugar de nacimiento no puede estar vacío.', 
            'lugar_nacimiento.max'          => 'Lugar de Nacimiento: Máximo 200 caracteres.',
            'fecha_egreso.date'             => 'Fecha de egreso: el formato de la fecha no es válido.', 
            'foto.required'                 => 'Debe seleccionar una foto.',
            'foto.mimes'                    => 'Sólo se aceptan formatos de imagen .jpg, .png.',
            'email_personal.email'          => 'Email Personal: el campo no tiene un formato válido.', 
            'email_personal.max'            => 'Email Personal: máximo 255 caracteres.', 
            'email_personal.unique'         => 'Email Personal: ya se ha asociado ese correo a otro usuario', 
            'email.email'                   => 'Email: el campo no tiene un formato válido.', 
            'email.max'                     => 'Email: máximo 255 caracteres.', 
            'email.unique'                  => 'Email: ya se ha asociado ese correo a otro usuario.', 
            'password.required'             => 'El campo de contraseña no puede estar vacío.',
            'password.min'                  => 'Contraseña: La cantidad de caracteres mínima es de 6.',
            'password.confirmed'            => 'Las confirmación de contraseña no coíncide.',
        ];
        
        $input = [
            'primer_nombre'         => $request['primer_nombre'], 
            'segundo_nombre'        => $request['segundo_nombre'], 
            'primer_apellido'       => $request['primer_apellido'], 
            'segundo_apellido'      => $request['segundo_apellido'], 
            'cedula'                => $request['tipo']."-".$request['cedula'],
            'rif'                   => $request['rif'], 
            'fecha_nacimiento'      => $request['fecha_nacimiento'],
            'edad'                  => $request['edad'],
            'sexo'                  => $request['sexo'],
            'fecha_ingreso'         => $request['fecha_ingreso'],
            'direccion'             => $request['direccion'], 
            'telefono_habitacion'   => $request['telefono_habitacion'], 
            'telefono_movil'        => $request['telefono_movil'], 
            'telefono_corporativo'  => $request['telefono_corporativo'], 
            'extension'             => $request['extension'], 
            'profesion_id'          => $request['profesion_id'], 
            'departamento_id'       => $request['departamento_id'], 
            'cargo_id'              => $request['cargo_id'], 
            'sueldo'                => $request['sueldo'], 
            'cargas'                => $request['cargas'], 
            'estado_civil'          => $request['estado_civil'], 
            'lugar_nacimiento'      => $request['lugar_nacimiento'],
            'is_active'             => $request['estatus'],
        ];

        if($request['fecha_egreso'] != $user->fecha_egreso){
            if($request['fecha_egreso'] != '')
                $constraints['fecha_egreso'] = 'date';
            $input['fecha_egreso'] = $request['fecha_egreso'];
        }

        if($request['email_personal'] != $user->email_personal){
            $constraints['email_personal'] = 'nullable|email|max:255|unique:users';
            $input['email_personal'] = $request['email_personal'];
        } 

        if($request['email'] != $user->email){
            $constraints['email'] = 'nullable|email|max:255|unique:users';
            $input['email'] = $request['email'];
        }        

        if ($request->hasFile('foto')){
            $constraints['foto'] = 'required|mimes:jpeg,png';
            $input['foto'] = $request['foto'];
        }        

        if ($request['password'] != null && strlen($request['password']) > 0) {
            $constraints['password'] = 'required|min:6|confirmed';
            $input['password'] =  bcrypt($request['password']);            
        }

        $this->validate($request, $constraints, $mensajes);

        unset($input['foto']);

        

        if ($request->hasFile('foto')){
            $imageName =    $input['cedula'] . 
                            $request['primer_nombre'] . 
                            " " . $request['primer_apellido'] . 
                            '.' . $request->file('foto')->getClientOriginalExtension();

            $arr1 = ['á', 'é', 'í', 'ó', 'ú', 'ñ'];
            $arr2 = ['a', 'e', 'i', 'o', 'u', 'n'];

            $imageName = str_replace($arr1, $arr2, $imageName);

            $image = $request->file('foto');
            $path = public_path('images/' . $imageName);
            
            $input['imagen'] =  $imageName;

            Image::make($image->getRealPath())->resize(152, 152)->save($path);
        }

        \App\User::where('id', $id)->update($input);
        
        Session::flash('status', "Se ha modificado correctamente al usuario: " . $request['primer_nombre'] . " " . $request['primer_apellido']);

        return redirect()->intended('/usuarios');
    }

    public function updatePassword(Request $request)
    {        
        $user = User::findOrFail(Auth::id());       

        $mensajes = [
            'password_old.required'         => 'La contraseña actual no coíncide, no es posible realizar el cambio de contraseña.',
            'password.required'             => 'El campo de contraseña no puede estar vacío.',
            'password.min'                  => 'Contraseña: La cantidad de caracteres mínima es de 6.',
            'password.confirmed'            => 'Las confirmación de contraseña no coíncide.',
        ];

        $constraints['password'] = 'required|min:6|confirmed';
        $constraints['password_old'] = 'required';

        $input['password'] =  bcrypt($request['password']);   

        if(Hash::check($request['password_old'], $user->password) === false){
            $request->offsetUnset('password_old');
        }

        $this->validate($request, $constraints, $mensajes);        

        \App\User::where('id', Auth::id())->update($input);
       
        Session::flash('status', "Se ha modificado correctamente su contraseña.");

        return redirect()->intended('/home');
    }


    /**
     * Remove the specified resource from storage.
     * es válido usar cualquiera de los 2 métodos
     * ya sea destroy o show, sólo usar el destroy
     * cuando se esté intentando eliminar desde un formulario
     * de lo contrario usar el método show
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {          

    }

    /**
     * método modificado para eliminar un usuario
     * 
    */
    public function show($id){
 
    }

    private function validateInput($request) {
        $reglas = [
            'primer_nombre'         => 'required|max:20|alpha', 
            'segundo_nombre'        => 'nullable|max:20|alpha', 
            'primer_apellido'       => 'required|max:20|alpha', 
            'segundo_apellido'      => 'nullable|max:20|alpha', 
            'cedula'                => 'required|max:8',
            'rif'                   => 'required|max:12', 
            'fecha_nacimiento'      => 'required|date', 
            'edad'                  => 'required|numeric',
            'sexo'                  => 'required|alpha',
            'fecha_ingreso'         => 'required|date',
            'direccion'             => 'required|max:200', 
            'telefono_habitacion'   => 'required', 
            'telefono_movil'        => 'required',
            'telefono_corporativo'  => 'nullable', 
            'extension'             => 'nullable|numeric', 
            'profesion_id'          => 'required|numeric', 
            'departamento_id'       => 'required|numeric', 
            'cargo_id'              => 'required|numeric', 
            'sueldo'                => 'required', 
            'cargas'                => 'required|numeric', 
            'estado_civil'          => 'required|alpha', 
            'lugar_nacimiento'      => 'required|max:200', 
            'fecha_egreso'          => 'nullable|date',
            'foto'                  => 'required|mimes:jpeg,png', 
            'email_personal'        => 'nullable|email|max:255|unique:users',                      
            'email'                 => 'nullable|email|max:255|unique:users',            
            'password'              => 'required|min:6|confirmed'
        ];

        $mensajes = [
            'primer_nombre.required'        => 'El primer nombre no puede estar vacío.', 
            'primer_nombre.max'             => 'Primer nombre: Máximo 20 caracteres por nombre.',
            'primer_nombre.alpha'           => 'Primer nombre: Sólo se permiten caracteres alfabéticos.',
            'segundo_nombre.max'            => 'Segundo nombre: Máximo 20 caracteres por nombre.',
            'segundo_nombre.alpha'          => 'Segundo nombre: Sólo se permiten caracteres alfabéticos.',
            'primer_apellido.required'      => 'El primer apellido no puede estar vacío.', 
            'primer_apellido.max'           => 'Primer apellido: Máximo 20 caracteres por apellido.',
            'primer_apellido.alpha'         => 'Primer apellido: Sólo se permiten caracteres alfabéticos.',
            'segundo_apellido.max'          => 'Segundo apellido: Máximo 20 caracteres por apellido.',
            'segundo_apellido.alpha'        => 'Segundo apellido: Sólo se permiten caracteres alfabéticos.',
            'cedula.required'               => 'La cédula no puede estar vacía',
            'cedula.max'                    => 'Cédula: Máximo 8 caracteres.',
            'rif.required'                  => 'El RIF no puede estar vacío',
            'rif.max'                       => 'RIF: Máximo 12 caracteres.',
            'fecha_nacimiento.required'     => 'La fecha de nacimiento no puede estar vacía.',
            'fecha_nacimiento.date'         => 'Fecha de nacimiento: el formato de la fecha no es válido.',
            'edad.required'                 => 'La edad no pueden estar vacía.',
            'edad.numeric'                  => 'La edad debe ser un valor numérico.', 
            'sexo.required'                 => 'El campo de sexo no puede estar vacío.',
            'sexo.alpha'                    => 'Sexo: sólo se permiten caracteres alfabéticos.',
            'fecha_ingreso.required'        => 'La fecha de ingreso no puede estar vacía.',
            'fecha_ingreso.date'            => 'Fecha de ingreso: el formato de la fecha no es válido.', 
            'direccion.required'            => 'La dirección no puede estar vacía.', 
            'direccion.max'                 => 'Dirección: Máximo 200 caracteres.',
            'telefono_habitacion.required'  => 'El teléfono de habitación no puede estar vacío',
            'telefono_movil.required'       => 'El teléfono móvil no puede estar vacío',
            'extension.numeric'             => 'La extensión sólo puede ser numérica.',
            'profesion_id.required'         => 'La profesión no puede estar vacía.', 
            'profesion_id.numeric'          => 'La profesión sólo puede ser un valor numérico.',
            'departamento_id.required'      => 'El departamento es requerido.',
            'departamento_id.numeric'       => 'El departamento sólo puede ser un valor numérico.',
            'cargo_id.required'             => 'El cargo es requerido.',
            'cargo_id.numeric'              => 'El cargo sólo puede ser un valor numérico.',
            'sueldo.required'               => 'El sueldo no puede estar vacío.',
            'cargas.required'               => 'Las cargas familiares no pueden estar vacías.',
            'cargas.numeric'                => 'Las cargas familiares deben ser un valor numérico.',
            'estado_civil.required'         => 'El campo de hijos no puede estar vacío.',
            'estado_civil.alpha'            => 'Estado civil: sólo se permiten caracteres alfabéticos.',
            'lugar_nacimiento.required'     => 'El lugar de nacimiento no puede estar vacío.', 
            'lugar_nacimiento.max'          => 'Lugar de Nacimiento: Máximo 200 caracteres.',
            'fecha_egreso.date'             => 'Fecha de egreso: el formato de la fecha no es válido.', 
            'foto.required'                 => 'Debe seleccionar una foto.',
            'foto.mimes'                    => 'Sólo se aceptan formatos de imagen .jpg, .png.', 
            'email_personal.email'          => 'Email Personal: el campo no tiene un formato válido.', 
            'email_personal.max'            => 'Email Personal: máximo 255 caracteres.', 
            'email_personal.unique'         => 'Email Personal: ya se ha asociado ese correo a otro usuario',  
            'email.email'                   => 'Email: el campo no tiene un formato válido.', 
            'email.max'                     => 'Email: máximo 255 caracteres.', 
            'email.unique'                  => 'Email: ya se ha asociado ese correo a otro usuario.', 
            'password.required'             => 'El campo de contraseña no puede estar vacío.',
            'password.min'                  => 'Contraseña: La cantidad de caracteres mínima es de 6.',
            'password.confirmed'            => 'Las confirmación de contraseña no coíncide.',
        ];

        $this->validate($request, $reglas, $mensajes);
    }
}
