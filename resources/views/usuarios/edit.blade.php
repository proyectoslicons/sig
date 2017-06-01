@extends('layouts.master')

@section('content')
    
    

    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Gestión de Usuarios</h3>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar Usuario</h2>
                    <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('usuarios.update', ['id' => $user->id]) }}">

                      <input type="hidden" name="_method" value="PATCH">
                      {{ csrf_field() }}


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="primer_nombre">Primer Nombre <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="primer_nombre" required="required" class="form-control col-md-7 col-xs-12" name="primer_nombre" value="{{ $user->primer_nombre }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="segundo_nombre">Segundo Nombre <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="segundo_nombre" required="required" class="form-control col-md-7 col-xs-12" name="segundo_nombre" value="{{ $user->segundo_nombre }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="primer_apellido">Primer Apellido <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="primer_apellido" required="required" class="form-control col-md-7 col-xs-12" name="primer_apellido" value="{{ $user->primer_apellido }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="segundo_apellido">Segundo Apellido <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="segundo_apellido" required="required" class="form-control col-md-7 col-xs-12" name="segundo_apellido" value="{{ $user->segundo_apellido }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cedula">Cédula <span class="required">*</span>
                        </label>

                        @php
                          $cedula = explode ("-", $user->cedula);
                        @endphp

                        <div class="col-md-1 col-sm-2 col-xs-3">
                          <select class="select2_single form-control" id="tipo" name="tipo">
                            <option value="E">E</option>
                            <option value="V">V</option>
                            <option value="P">P</option>
                          </select>
                        </div>
                        
                        <script> 
                            @php 
                              if($cedula[0] === "E"){
                            @endphp
                                $("#tipo").val("E"); 
                            @php
                              }
                              else{
                                if($cedula[0] === "V"){
                            @endphp
                                  $("#tipo").val("V");
                            @php
                                }
                                else{              
                            @endphp
                                  $("#tipo").val("P");
                            @php
                                }
                              }              
                            @endphp
                        </script>
                        
                        <div class="col-md-5 col-sm-4 col-xs-9">
                          
                          <input type="text" id="cedula" required="required" class="form-control col-md-7 col-xs-12" name="cedula" value="{{ $cedula[1] }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_nacimiento">Fecha de Nacimiento <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="fecha_nacimiento" required="required" class="form-control col-md-7 col-xs-12" name="fecha_nacimiento" value="{{ $user->fecha_nacimiento }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_ingreso">Fecha de Ingreso <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="fecha_ingreso" required="required" class="form-control col-md-7 col-xs-12" name="fecha_ingreso" value="{{ $user->fecha_ingreso }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="direccion">Dirección <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="direccion" required="required" class="form-control col-md-7 col-xs-12" name="direccion" value="{{ $user->direccion }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono_habitacion">Teléfono de Habitación <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="telefono_habitacion" required="required" class="form-control col-md-7 col-xs-12" name="telefono_habitacion" value="{{ $user->telefono_habitacion }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono_movil">Teléfono Móvil <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="telefono_movil" required="required" class="form-control col-md-7 col-xs-12" name="telefono_movil" value="{{ $user->telefono_movil }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extension">Extensión <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="extension" required="required" class="form-control col-md-7 col-xs-12" name="extension" value="{{ $user->extension }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profesion">Profesión <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="profesion" required="required" class="form-control col-md-7 col-xs-12" name="profesion" value="{{ $user->profesion }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento_id">Departamento <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" name="departamento_id" id="departamento_id">                              
                            @foreach($departments as $department)
                              <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                          </select>

                          <script>         
                            $("#departamento_id").val("{{$user->departamento_id}}");
                          </script>

                        </div>
                      </div>                      

                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cargo_id">Cargo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" name="cargo_id" id="cargo_id">                              
                            @foreach($positions as $position)
                              <option value="{{$position->id}}">{{$position->name}}</option>
                            @endforeach
                          </select>

                          <script>         
                            $("#cargo_id").val("{{$user->cargo_id}}");
                          </script>

                        </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sueldo">Sueldo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="sueldo" required="required" class="form-control col-md-7 col-xs-12" name="sueldo" value="{{ $user->sueldo }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cargas">Cargas <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="cargas" required="required" class="form-control col-md-7 col-xs-12" name="cargas" value="{{ $user->cargas }}" min=0>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pareja">Pareja <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="pareja" required="required" class="form-control col-md-7 col-xs-12" name="pareja" value="{{ $user->pareja }}" min=0>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hijos">Hijos <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="hijos" required="required" class="form-control col-md-7 col-xs-12" name="hijos" value="{{ $user->hijos }}" min=0>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado_civil">Estado Civil <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="estado_civil" required="required" class="form-control col-md-7 col-xs-12" name="estado_civil" value="{{ $user->estado_civil }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lugar_nacimiento">Lugar Nacimiento <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="lugar_nacimiento" required="required" class="form-control col-md-7 col-xs-12" name="lugar_nacimiento" value="{{ $user->lugar_nacimiento }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="email" required="required" class="form-control col-md-7 col-xs-12" name="email" value="{{ $user->email }}">
                        </div>
                      </div>        

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estatus">Estatus <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" id="estatus" name="estatus">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                          </select>   

                          <script> 
                            @php 
                              if($user->is_active === 1){
                            @endphp
                                $("#estatus").val("1"); 
                            @php
                              }
                              else{
                            @endphp
                                $("#estatus").val("0");
                            @php
                              }              
                            @endphp
                          </script>

                        </div>
                      </div>

                      <div class="form-group">
                        <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" class="form-control col-md-7 col-xs-12" type="password" name="password">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="password-confirm" class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar Contraseña</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password_confirmation" class="form-control col-md-7 col-xs-12" type="password" name="password_confirmation">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5 col-xs-offset-5">
                          <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                      </div>

                    </form>

                    @include('layouts.errors')

                  </div>
                </div>
              </div>
            </div>
      </div>
    </div>
<br><br>
@endsection