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
                <h2>Registrar Usuarios</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />                    

                <form method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('usuarios.store') }}" enctype="multipart/form-data">

                  {{ csrf_field() }}

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="primer_nombre">Primer Nombre <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="primer_nombre" required="required" class="form-control col-md-7 col-xs-12" name="primer_nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="segundo_nombre">Segundo Nombre <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="segundo_nombre" required="required" class="form-control col-md-7 col-xs-12" name="segundo_nombre">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="primer_apellido">Primer Apellido <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="primer_apellido" required="required" class="form-control col-md-7 col-xs-12" name="primer_apellido">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="segundo_apellido">Segundo Apellido <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="segundo_apellido" required="required" class="form-control col-md-7 col-xs-12" name="segundo_apellido">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cedula">Cédula <span class="required">*</span>
                    </label>

                    <div class="col-md-1 col-sm-2 col-xs-3">
                      <select class="select2_single form-control" id="tipo" name="tipo">
                        <option value="E">E</option>
                        <option value="V">V</option>
                        <option value="P">P</option>
                      </select>
                    </div>                    
                    
                    <div class="col-md-5 col-sm-4 col-xs-9">
                      
                      <input type="text" id="cedula" required="required" class="form-control col-md-7 col-xs-12" name="cedula">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_nacimiento">Fecha de Nacimiento <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="fecha_nacimiento" type="text" class="form-control has-feedback-left" name="fecha_nacimiento">
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
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_ingreso">Fecha de Ingreso <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="fecha_ingreso" type="text" class="form-control has-feedback-left" name="fecha_ingreso">
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
                      <input type="text" id="direccion" required="required" class="form-control col-md-7 col-xs-12" name="direccion">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono_habitacion">Teléfono de Habitación <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="telefono_habitacion" required="required" class="form-control col-md-7 col-xs-12" name="telefono_habitacion">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono_movil">Teléfono Móvil <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="telefono_movil" required="required" class="form-control col-md-7 col-xs-12" name="telefono_movil">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="extension">Extensión <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="extension" required="required" class="form-control col-md-7 col-xs-12" name="extension">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profesion">Profesión <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="profesion" required="required" class="form-control col-md-7 col-xs-12" name="profesion">
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
                    </div>
                  </div> 

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sueldo">Sueldo <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="number" step="any" id="sueldo" required="required" class="form-control col-md-7 col-xs-12" name="sueldo">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cargas">Cargas <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="number" id="cargas" required="required" class="form-control col-md-7 col-xs-12" name="cargas" min=0>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pareja">Pareja <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="number" id="pareja" required="required" class="form-control col-md-7 col-xs-12" name="pareja" min=0>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hijos">Hijos <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="number" id="hijos" required="required" class="form-control col-md-7 col-xs-12" name="hijos" min=0>
                    </div>
                  </div>                    

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado_civil">Estado Civil <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="select2_single form-control" id="estado_civil" name="estado_civil">
                        <option value="Soltero">Soltero</option>
                        <option value="Casado">Casado</option>
                        <option value="Divorciado">Divorciado</option>
                      </select>   
                    </div>
                  </div>                  

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lugar_nacimiento">Lugar Nacimiento <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <select class="select2_single form-control" id="lugar_nacimiento" name="lugar_nacimiento">                            
                        @foreach($cities as $city)
                          <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                      </select>   
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="email" id="email" class="form-control col-md-7 col-xs-12" name="email">
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
                    </div>
                  </div>

                  

                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_egreso">Fecha de Egreso <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="fecha_egreso" type="text" class="form-control has-feedback-left" name="fecha_egreso">
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
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="foto">Foto <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12"  style="top: 4px">
                      <input required="requiered" type="file" name="foto" id="foto">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="password" required="required" class="form-control col-md-7 col-xs-12" type="password" name="password">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="password_confirmation" class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar Contraseña</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input id="password_confirmation" class="form-control col-md-7 col-xs-12" type="password" name="password_confirmation" required="required">
                    </div>
                  </div>

                  <div class="ln_solid"></div>
                  
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5 col-xs-offset-5">
                      <button type="submit" class="btn btn-success">Registrar</button>
                    </div>
                  </div>

                </form>

                @include('layouts.errors')
                @include('layouts.success')

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<br><br>
@endsection