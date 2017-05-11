@extends('layouts.master')

@php
use App\State;
use App\Country;
@endphp

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
                <h2>Registrar Ciudad</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                </ul>
                <div class="clearfix"></div>
              </div>                  

              <div class="x_content">                  
                  <a href="{{ route('ciudades.create') }}" class="btn btn-success" style="background-color: rgb(51, 204, 204)"><i class="fa fa-plus-circle"></i> Registrar ciudad</a>
              </div>
            </div>


            <div class="x_panel">
              <div class="x_title">
                <h2>Lista de Estados</h2>
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
                      <th style="width: 33%">Estado</th>
                      <th style="width: 33%">Nombre de la Ciudad</th>
                      <th style="width: 33%">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 

                      $cities = DB::table('city')
                      ->leftJoin('state', 'city.state_id', '=', 'state.id')
                      ->select('city.id', 'city.name', 'state.name as state_name', 'state.id as state_id')->get();                                                              
                      foreach ($cities as $city){
                        
                    @endphp


                      <tr>
                        <td>{{ $city->state_name }}</td>
                        <td>{{ $city->name }}</td>
                        <td>

                          <form class="row" method="POST" action="{{ route('ciudades.destroy', ['id' => $city->id]) }}" onsubmit = "return confirm('Eliminar Ciudad?')">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                            <a href="{{ route('ciudades.edit', ['id' => $city->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin btn-xs" style="margin-left: 5px; margin-right: 5px;">
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