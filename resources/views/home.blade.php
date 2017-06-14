@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main" >

      <div class="">
        <div class="clearfix"></div>

        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Menú General</h2>
                    <ul class="nav navbar-right panel_toolbox" style="right: -50px">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">                  
                    <div class="bs-glyphicons">
                        <ul class="bs-glyphicons-list">   
                          @if(Auth::user()->is_admin)                                          
                          <a>
                            <li>                            
                              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                              <span class="glyphicon-class">Parámetros del Sistema</span>
                            </li>
                          </a>

                          <li>
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                            <span class="glyphicon-class">Gestión de Usuarios</span>
                          </li>                     
                          @endif                             
                                                                                                      
                          <li>
                            <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
                            <span class="glyphicon-class">Gestión de Solicitudes</span>
                          </li>                                                                       

                        </ul>
                      </div>
                  </div>
                </div>
                    
      </div>
      </div>
      </div>
    </div>
<br><br>
@endsection