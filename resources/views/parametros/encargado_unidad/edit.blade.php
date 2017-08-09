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
                    <h2>Editar Encargado Unidad Funcional</h2>
                    <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ url('actualizarEncargado') }}">

                      {{ csrf_field() }}
                      
                      <input type="hidden" name="department_id" value="{{$department->id}}">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Unidad Funcional
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" disabled="disabled" id="name" required="required" class="form-control col-md-7 col-xs-12" name="department" value="{{ $department->name }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colaborador_id">Colaboradores <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
                          @php
                            $colaboradores = \App\User::where('departamento_id', $department->id)->get();
                          @endphp

                          <select class="select2_single form-control" name="colaborador_id" id="colaborador">                              
                            @foreach($colaboradores as $col)
                              <option value="{{$col->id}}">{{ ucwords($col->primer_nombre . " " . $col->primer_apellido) }}</option>
                            @endforeach
                            
                            <script>
                              $("#colaborador").val( {{ $department_head->id }} );
                            </script>

                          </select>

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