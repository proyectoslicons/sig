@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Gestión de usuarios</h3>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar usuario</h2>
                    <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('usuarios.update', ['id' => $user->id]) }}" enctype="multipart/form-data">

                      <input type="hidden" name="_method" value="PATCH">
                      {{ csrf_field() }}


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="primer_nombre">Primer nombre <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="primer_nombre" required="required" class="form-control col-md-7 col-xs-12" name="primer_nombre" value="{{ $user->primer_nombre }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="segundo_nombre">Segundo nombre 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="segundo_nombre" class="form-control col-md-7 col-xs-12" name="segundo_nombre" value="{{ $user->segundo_nombre }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="primer_apellido">Primer apellido <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="primer_apellido" required="required" class="form-control col-md-7 col-xs-12" name="primer_apellido" value="{{ $user->primer_apellido }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="segundo_apellido">Segundo apellido 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="segundo_apellido" class="form-control col-md-7 col-xs-12" name="segundo_apellido" value="{{ $user->segundo_apellido }}">
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rif">RIF <span class="required">*</span>
                        </label>                  
                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <input type="text" id="rif" required="required" class="form-control col-md-7 col-xs-12" name="rif" value="{{$user->rif}}">
                        </div>
                      </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_nacimiento">Fecha de nacimiento <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="fecha_nacimiento" type="text" class="form-control has-feedback-left" name="fecha_nacimiento" value="{{ $user->fecha_nacimiento }}">
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                          </div>

                          <script>
                            $('#fecha_nacimiento').datepicker({
                              language: "es",
                              autoclose: true,
                              todayHighlight: true,
                              format: 'yyyy-mm-dd',
                            });
                          </script>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="edad">Edad <span class="required">*</span>
                          </label>                  
                          
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            
                            <input type="number" id="edad" min=0 required="required" class="form-control col-md-7 col-xs-12" name="edad" value="{{$user->edad}}">
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sexo">Sexo <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="select2_single form-control" id="sexo" name="sexo">
                              <option value="F">Femenino</option>
                              <option value="M">Masculino</option>
                            </select>   
                          </div>

                          <script>         
                            $("#sexo").val("{{$user->sexo}}");
                          </script>
                        </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_ingreso">Fecha de ingreso <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="fecha_ingreso" type="text" class="form-control has-feedback-left" name="fecha_ingreso" value="{{ $user->fecha_ingreso }}">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <script>
                          $('#fecha_ingreso').datepicker({
                            language: "es",
                            autoclose: true,
                            todayHighlight: true,
                            format: 'yyyy-mm-dd',
                          });
                        </script>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="direccion">Dirección <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="direccion" required="required" class="form-control col-md-7 col-xs-12" name="direccion" value="{{ $user->direccion }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono_habitacion">Teléfono de habitación <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="telefono_habitacion" required="required" class="form-control col-md-7 col-xs-12" name="telefono_habitacion" value="{{ $user->telefono_habitacion }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono_movil">Teléfono móvil <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="telefono_movil" required="required" class="form-control col-md-7 col-xs-12" name="telefono_movil" value="{{ $user->telefono_movil }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono_corporativo">Teléfono corporativo
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="telefono_corporativo" class="form-control col-md-7 col-xs-12" name="telefono_corporativo" value="{{$user->telefono_corporativo}}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extension">Extensión 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="extension" class="form-control col-md-7 col-xs-12" name="extension" value="{{ $user->extension }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profesion_id">Profesión <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" name="profesion_id" id="profesion_id" required="required">                              
                            @foreach($occupations as $occupation)
                              <option value="{{$occupation->id}}">{{$occupation->name}}</option>
                            @endforeach
                          </select>
                        </div>

                        <script>         
                          $("#profesion_id").val("{{$user->profesion_id}}");
                        </script>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento_id">Unidad funcional <span class="required">*</span>
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
                          <input type="number" step="any" id="sueldo" required="required" class="form-control col-md-7 col-xs-12" name="sueldo" value="{{ $user->sueldo }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cargas">Cargas familiares <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="cargas" required="required" class="form-control col-md-7 col-xs-12" name="cargas" value="{{ $user->cargas }}" min=0>
                        </div>
                      </div>                                        

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado_civil">Estado civil <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" id="estado_civil" name="estado_civil">
                            <option value="Soltero">Soltero</option>
                            <option value="Casado">Casado</option>
                            <option value="Divorciado">Divorciado</option>
                            <option value="Viudo">Viudo</option>
                          </select>   

                          <script> 
                            $("#estado_civil").val("{{$user->estado_civil}}");        
                          </script>

                        </div>
                      </div>                  

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lugar_nacimiento">Lugar nacimiento <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" id="lugar_nacimiento" name="lugar_nacimiento">                            
                            @foreach($states as $state)

                              <optgroup label="{{ucwords($state->name)}}">
                                
                                @php                            
                                  $cities = \App\City::where('state_id', $state->id)->orderBy('state_id', 'ASC')->get();
                                @endphp

                                @foreach($cities as $city)                          
                                  <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach

                              </optgroup>

                            @endforeach 
                          
                          </select>  

                          <script> 
                            $("#lugar_nacimiento").val("{{$user->lugar_nacimiento}}");        
                          </script>

                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_personal">Email personal 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email_personal" class="form-control col-md-7 col-xs-12" name="email_personal" value="{{ $user->email_personal }}">
                        </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email corporativo 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" class="form-control col-md-7 col-xs-12" name="email" value="{{ $user->email }}">
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
                              if($user->is_active == 1){
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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_egreso">Fecha de egreso
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="fecha_egreso" type="text" class="form-control has-feedback-left" name="fecha_egreso" value="{{ $user->fecha_egreso }}">
                          <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>

                        <script>
                          $('#fecha_egreso').datepicker({
                            language: "es",
                            autoclose: true,
                            todayHighlight: true,
                            format: 'yyyy-mm-dd',
                          });
                        </script>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Foto
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12"  style="top: 4px">
                          <input type="file" name="foto" id="foto">
                        </div>
                      </div>
                      
                      @if(Auth::user()->is_admin)
                        <div class="form-group">
                          <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password" class="form-control col-md-7 col-xs-12" type="password" name="password">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label for="password_confirmation" class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar contraseña</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="password_confirmation" class="form-control col-md-7 col-xs-12" type="password" name="password_confirmation">
                          </div>
                        </div>
                      @endif

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