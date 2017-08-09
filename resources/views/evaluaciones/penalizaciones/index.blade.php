@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Gestión de evaluaciones</h3>
          </div>
        </div>

        <div class="clearfix"></div>

        @include('layouts.errors')
        @include('layouts.success')

        <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12">

            <div class="x_panel">
              <div class="x_title">
                <h2>Target</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                </ul>
                <div class="clearfix"></div>
              </div>                  

              <div class="x_content">                  
                  <a href="{{ route('target.create') }}" class="btn btn-success" style="background-color: rgb(51, 204, 204)"><i class="fa fa-plus-circle"></i> Registrar target</a>

                  <div class="ln_solid"></div>

                  <div class="x_title">
                    <h2>Target actual</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">                    
                    @php
                      $target = \App\Target::latest()->First();
                    @endphp
                    
                    @if(count($target) > 0)                        
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr style="background-color: rgb(51, 204, 204); color: white; font-weight: bold">
                            <th>Target desde</th>
                            <th>Porcentaje</th>                              
                          </tr>
                        </thead>
                        
                        <tbody>                                                                                                                                                                        
                          <tr style="font-weight: bold;">                            
                            <td>
                              <center>                               
                                {{ $target->created_at->format('d-m-Y g:m a') }}
                              </center>
                            </td>                            

                            <td><center>{{$target->porcentaje}}%</center></td>                         
                          </tr>                                                                            
                        
                        </tbody>                      
                      </table>
                    @endif 

                    @if(count($target) == 0)
                      <div style="font-weight: bold;">{{'No se ha definido un target.'}}</div>
                    @endif                   

                  </div>
              </div>
            </div>


            
                    
        </div>

        <div class="col-md-6 col-sm-12 col-xs-12">

            <div class="x_panel">
              <div class="x_title">
                <h2>Target mínimo penalizaciones</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                </ul>
                <div class="clearfix"></div>
              </div>                  

              <div class="x_content">                  
                  <a href="{{ route('target.minimo') }}" class="btn btn-success" style="background-color: rgb(51, 204, 204)"><i class="fa fa-plus-circle"></i> Registrar target mínimo</a>

                  <div class="ln_solid"></div>

                  <div class="x_title">
                    <h2>Target mínimo actual</h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">                    
                    @php
                      $target_min = \App\TargetMinimo::latest()->First();
                    @endphp
                    
                    @if(count($target_min) > 0)                        
                      <table class="table table-bordered table-hover">
                        <thead>
                          <tr style="background-color: rgb(51, 204, 204); color: white; font-weight: bold">
                            <th>Target mínimo desde</th>
                            <th>Porcentaje</th>                              
                          </tr>
                        </thead>
                        
                        <tbody>                                                                                                                                                                        
                          <tr style="font-weight: bold;">                            
                            <td>
                              <center>                               
                                {{ $target_min->created_at->format('d-m-Y g:m a') }}
                              </center>
                            </td>                            

                            <td><center>{{$target_min->porcentaje}}%</center></td>                         
                          </tr>                                                                            
                        
                        </tbody>                      
                      </table>
                    @endif 

                    @if(count($target_min) == 0)
                      <div style="font-weight: bold;">{{'No se ha definido un target mínimo.'}}</div>
                    @endif

              </div>
            </div>


            
                    
        </div>
      </div>
      </div>
    </div>
<br><br>
@endsection