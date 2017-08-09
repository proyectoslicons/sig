@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Parámetros del Sistema</h3>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Asignar Encargado de Unidad Funcional</h2>
                    <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" method="POST" action="{{ route('encargado.store') }}">

                      {{ csrf_field() }}
                    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profesion_id">Unidad Funcional <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          <select class="select2_single form-control" name="department_id" id="department">                              
                            @foreach($departamentos as $department)
                              <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                          
                          </select>

                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colaborador_id">Colaboradores <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          @php
                            $colaboradores = \App\User::where('departamento_id', $departamentos[0]->id)->get();
                          @endphp

                          <select class="select2_single form-control" name="colaborador_id" id="colaborador">                              
                            @foreach($colaboradores as $col)
                              <option value="{{$col->id}}">{{ ucwords($col->primer_nombre) . " " . ucwords($col->primer_apellido)}}</option>
                            @endforeach
                          
                          </select>

                        </div>
                      </div>   

                      <script>
                        $(document).ready(function($){
                          $('#department').change(function(){                                                              
                            $.get("{{ url('api/empleados') }}",  
                              function(data) {                                
                                var i = 0;
                                $('#colaborador').empty();
                                for(i = 0; i < data.length; i++){
                                  if(data[i].departamento_id == $('#department').val()){ 
                                    var string = data[i].primer_nombre;
                                    var nombre = string.charAt(0).toUpperCase() + string.slice(1);
                                    string = data[i].primer_apellido;
                                    var apellido = string.charAt(0).toUpperCase() + string.slice(1);
                                    
                                    if(data[i].is_active == 1)
                                      $('#colaborador').append("<option value='" + data[i].id +"'>" + nombre + " " + apellido + "</option>");
                                  }
                                }                                    
                            });
                          });
                        });
                      </script>                      

                      <div class="ln_solid"></div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5 col-xs-offset-5">
                          <button type="submit" class="btn btn-success">Asignar</button>
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