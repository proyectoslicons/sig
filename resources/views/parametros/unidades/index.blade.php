@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Gestión de Unidades Funcionales</h3>
          </div>
        </div>

        @include('layouts.errors')
        @include('layouts.success')

        <div class="clearfix"></div>

        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
              <div class="x_title">
                <h2>Registrar Unidades Funcionales</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                </ul>
                <div class="clearfix"></div>
              </div>                  

              <div class="x_content">                  
                  <a href="{{ route('unidades.create') }}" class="btn btn-success" style="background-color: rgb(51, 204, 204)"><i class="fa fa-plus-circle"></i> Registrar Unidad Funcional</a>
              </div>
            </div>


            <div class="x_panel">
              <div class="x_title">
                <h2>Lista de Unidades Funcionales</h2>
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
                      <th style="width: 50%">Unidad Funcional</th>                      
                      <th style="width: 50%">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                      $departamentos = App\Department::chunk(10, function($departamentos){
                      foreach ($departamentos as $depart){
                    @endphp
                      <tr>
                        <td>{{ $depart->name }}</td>                        
                        <td>

                          <form class="row" method="POST" action="{{ route('unidades.destroy', ['id' => $depart->id]) }}" onsubmit = "return confirm('Eliminar Unidad Funcional?')">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                            <a href="{{ route('unidades.edit', ['id' => $depart->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin btn-xs" style="margin-left: 5px; margin-right: 5px;">
                              Editar
                            </a>
                            
                            <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin btn-xs">
                              Eliminar
                            </button>
                            
                          </form>
                        </td>
                      </tr>
                    @php                        
                        }
                      });
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