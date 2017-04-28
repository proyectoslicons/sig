@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main" style="height:     auto;>

        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Gestión de Usuarios</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">                  
          
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%">
                      <thead>
                        <tr style="background-color: rgb(51, 204, 204)">
                          <th style="width: 33%">Nombre</th>
                          <th style="width: 33%">Email</th>
                          <th style="width: 33%">Acciones</th>
                        </tr>
                      </thead>

                      <tbody>

                        @php 
                          $usuarios = App\User::chunk(10, function($usuarios){

                          foreach ($usuarios as $user){
                        @endphp
                        
                          <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td></td>
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

@endsection