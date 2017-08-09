@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Gestión de Evaluaciones</h3>
          </div>
        </div>

        <div class="clearfix"></div>

        @include('layouts.errors')
        @include('layouts.success')

        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
              <div class="x_title">
                <h2>Registrar Nuevo Instrumento</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                </ul>
                <div class="clearfix"></div>
              </div>                  

              <div class="x_content">                  
                  <a href="{{ route('instrumentos.create') }}" class="btn btn-success" style="background-color: rgb(51, 204, 204)"><i class="fa fa-plus-circle"></i> Registrar Instrumento</a>
              </div>
            </div>

            <div class="x_panel">
              <div class="x_title">                

                <h2>{{ ucwords($department->name) . " - " . ucwords($position->name) }} - Instrumentos Asociados</h2>
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
                      <th style="width: 43%">Instrumento</th>
                      <th style="width: 13%">Porcentaje</th>
                      <th style="width: 43%">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                      foreach ($instrumentos as $pos){
                    @endphp
                      <tr>
                        <td>{{ ucwords($pos->descripcion) }}</td>
                        <td style="font-weight: bold"><center>{{ $pos->porcentaje }}%</center></td>
                        <td>

                          <a href="{{ route('listar_dimensiones', ['id' => $pos->id]) }}" class="btn btn-info col-sm-5 col-xs-9 btn-margin btn-xs" style="margin-left: 5px; margin-right: 5px;">
                            Ver Dimensiones
                          </a>    

                          <a href="{{ route('instrumentos.edit', ['id' => $pos->id]) }}" class="btn btn-warning col-sm-3 col-xs-9 btn-margin btn-xs">
                            Editar
                          </a>  

                          <form class="row" method="POST" action="{{ route('instrumentos.destroy', ['id' => $pos->id]) }}" onsubmit = "return confirm('Eliminar Instrumento?')">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">                          
                                                        
                            <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin btn-xs">
                              Eliminar
                            </button>
                            
                          </form>                                         

                        </td>
                      </tr>
                    @php                        
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