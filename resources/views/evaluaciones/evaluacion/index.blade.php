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
        <div class="col-md-12 col-sm-12 col-xs-12">            

            <div class="x_panel">
              <div class="x_title">
                <h2>Lista de evaluaciones pendientes</h2>
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
                      <th style="width: 15%">Cédula</th>
                      <th style="width: 10%">Foto</th>
                      <th style="width: 25%">Colaborador a evaluar</th> 
                      <th style="width: 25%">Cargo</th> 
                      <th style="width: 20%">Acciones</th>
                    </tr>
                  </thead>
                 
                  <tbody>
                      <tr>
                        <td>{{ "V-20123873" }}</td>
                        <td><center><div class="user-profile"><img src="http://10.0.0.10/images/V-20123873Joel Heredia.jpg" alt=""></div></center></td>
                        <td>{{ "Joel Heredia" }}</td>
                        <td>{{ "Supervisor de sistemas de información" }}</td>                        
                        <td>

                          <a href="{{ route('evaluacion.show', ['id' => 1]) }}" class="btn btn-info col-sm-5 col-xs-5 btn-margin btn-xs" style="margin-left: 5px; margin-right: 5px;">
                              Evaluar
                          </a>

                        </td>
                      </tr>
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