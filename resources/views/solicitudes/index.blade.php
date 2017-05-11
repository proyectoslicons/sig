@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Gestión de Solicitudes</h3>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
              <div class="x_title">
                <h2>Lista de Tickets</h2>
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
                      <th style="width: 10%">Cód. Ticket</th>
                      <th style="width: 20%">Título</th>
                      <th style="width: 10%">Estado</th>
                      <th style="width: 20%">Categoría</th>
                      <th style="width: 20%">Actualizado</th>
                      <th style="width: 20%;">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php 
                      
                      foreach ($tickets as $ticket){
                    @endphp
                      <tr>
                        
                        <td>
                            <a href="{{ url('solicitudes/ticket/'. $ticket->ticket_id) }}">
                                {{ $ticket->ticket_id }}
                            </a>
                        </td>

                        <td>
                             {{ $ticket->title }}                            
                        </td>

                        <td>
                            <center>
                              @if ($ticket->status === 'Open')
                                  <div class="label label-success">{{ "Abierto" }}</div>
                              @else
                                  <div class="label label-danger">{{ "Cerrado" }}</div>
                              @endif
                            </center>                          
                        </td>

                        <td>
                          @php
                            $category = DB::table('categories')->where('id', $ticket->category_id)->value('name');
                          @endphp                          
                          {{ $category }}                                                        
                        </td>

                        <td>{{ $ticket->updated_at }}</td>

                        <td>
                            <form action="#" method="POST">
                                {{ csrf_field() }}
                                <a href="{{ url('solicitudes/ticket/' . $ticket->ticket_id) }}" class="btn btn-primary btn-xs">Comentar</a>
                                <button type="submit" class="btn btn-danger btn-xs">Cerrar</button>
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