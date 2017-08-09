@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main" >

      <div class="">
        <div class="clearfix"></div>

        @include('layouts.errors')
        @include('layouts.success')

        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Menú general</h2>
                    <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">                  
                    <div class="bs-glyphicons">
                        <ul class="bs-glyphicons-list">   
                          @if(Auth::user()->is_admin === 1)                                          
                          <a>
                            <li>                            
                              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                              <span class="glyphicon-class">Parámetros del sistema</span>
                            </li>
                          </a>
                          @endif

                          @if(Auth::user()->is_admin === 1 || Auth::user()->departamento_id === 3)
                          <a href="{{ url('usuarios') }}"> 
                            <li>
                              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                              <span class="glyphicon-class">Gestión de usuarios</span>
                            </li>
                          </a>                     
                          @endif                             
                            
                          <a href="{{ url('solicitudes/listarTickets') }}">         
                            <li>                            
                              <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
                              <span class="glyphicon-class">Gestión de solicitudes</span>
                            </li>  
                          </a>     

                          <a href="{{ url('contactos') }}">         
                            <li>                            
                              <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
                              <span class="glyphicon-class">Libreta de contactos</span>
                            </li>  
                          </a>                                                                 

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