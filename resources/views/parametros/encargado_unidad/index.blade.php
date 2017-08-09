@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Parámetros del Sistema</h3>
          </div>
        </div>

        @include('layouts.errors')
        @include('layouts.success')

        <div class="clearfix"></div>

        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
              <div class="x_title">
                <h2>Asignar Encargado Unidad Funcional</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                </ul>
                <div class="clearfix"></div>
              </div>                  

              <div class="x_content">                  
                  <a href="{{ route('encargado.create') }}" class="btn btn-success" style="background-color: rgb(51, 204, 204)"><i class="fa fa-plus-circle"></i> Asignar Encargado</a>
              </div>
            </div>


            <div class="x_panel">
              <div class="x_title">
                <h2>Lista de Encargados Unidades Funcionales</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                </ul>
                <div class="clearfix"></div>
              </div>                  

              <div class="x_content">                  
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%">
                  <thead>
                    <tr style="background-color: rgb(51, 204, 204)">
                      <th style="width: 40%">Unidad Funcional</th>
                      <th style="width: 30%">Encargado</th>                      
                      <th style="width: 30%">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 

                      foreach ($departamentos as $depart){                        
                        if($depart->id_department_head !== NULL){
                          $colaborador = \App\User::where('id', $depart->id_department_head)->First();
                    @endphp
                    
                      <tr>
                        <td>{{ $depart->name }}</td>
                        <td>{{ucwords($colaborador->primer_nombre . " " . $colaborador->primer_apellido)}}</td>                        
                        <td>                                                      
                          <a href="{{ route('encargado.edit', ['id' => $colaborador->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin btn-xs" style="margin-left: 5px; margin-right: 5px;">
                            Editar
                          </a>                                                
                        </td>
                      </tr>
                    
                    @php                        
                        }
                      }                      
                    @endphp

                  </tbody>
                </table>
              </div>
            </div>
                    
      </div>
      </div>
      </div>
    </div>
<br><br>
@endsection