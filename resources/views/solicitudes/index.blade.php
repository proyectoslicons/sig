@extends('layouts.master')

@section('content')

    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Gestión de solicitudes</h3>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">
                <div class="x_title">
                  <h2>Menú de tickets</h2>
                  <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                      
                  </ul>
                  <div class="clearfix"></div>

                  @include('layouts.errors')
                  @include('layouts.success')
                
                </div>                  

                <div class="x_content">                  
                  <a href="{{ url('solicitudes/listarTickets') }}" type="button" class="btn btn-success" style="background-color: rgb(51, 204, 204);">Tickets recibidos</a>
                  <a href="{{ url('solicitudes/listarTicketsCreados') }}" type="button" class="btn btn-success" style="background-color: rgb(51, 204, 204);">Tickets creados</a>
                  <a href="{{ url('solicitudes/TicketsCerrados') }}" type="button" class="btn btn-success" style="background-color: rgb(51, 204, 204);">Tickets cerrados atendidos</a>
                  <a href="{{ url('solicitudes/TicketsCerradosUsuario') }}" type="button" class="btn btn-success" style="background-color: rgb(51, 204, 204);">Tickets cerrados usuario</a>                  
                </div>
              </div>
                      
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12">

              <div class="x_panel">
                <div class="x_title">
                  <h2>Lista de tickets recibidos</h2>
                  <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                      
                  </ul>
                  <div class="clearfix"></div>

                  @include('layouts.errors')
                  @include('layouts.success')
                
                </div>                  

                <div class="x_content">                  
                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%">
                    <thead>
                      <tr style="background-color: rgb(51, 204, 204);">                      
                        <th style="width: 10%">Cód. ticket</th>
                        <th style="width: 10%">Título</th>
                        <th style="width: 10%">Estado</th>
                        <th style="width: 10%">Prioridad</th>
                        <th style="width: 10%">Horas atención</th>
                        <th style="width: 10%">Solicita</th>
                        <th style="width: 10%">F. creación</th>                      
                      </tr>
                    </thead>
                    <tbody>
                      @php 
                        
                        foreach ($tickets as $ticket){
                      @endphp

                        @if($ticket->status === 'Pending')                      
                          <tr style="background-color: #ffddcc;">                      
                        @else
                          <tr>
                        @endif

                          <td>
                              <a style="color: rgb(51, 204, 204); font-weight: bold" href="{{ url('solicitudes/ticket/'. $ticket->ticket_id) }}">
                                  {{ $ticket->ticket_id }}
                              </a>
                          </td>

                          <td>
                               {{ $ticket->title }}                            
                          </td>

                          <td>
                              <center>
                                @if($ticket->status === 'Open')
                                    <div class="label label-success">{{ "Abierto" }}</div>
                                @endif

                                @if($ticket->status === 'Closed')
                                    <div class="label label-danger">{{ "Cerrado" }}</div>
                                @endif
                                
                                @if($ticket->status === 'Pending')
                                    <div class="label label-warning">{{ "Pendiente por Cerrar" }}</div>
                                @endif
                              </center>                          
                          </td>

                          <td>
                              <center>
                                @if($ticket->priority === 'inmediato')
                                  <div class="label label-danger">{{ ucfirst($ticket->priority) }}</div>
                                  @php
                                    $total = 4;
                                  @endphp
                                @endif
                                
                                @if($ticket->priority === 'imperativo')
                                  <div class="label label-warning">{{ ucfirst($ticket->priority) }}</div>
                                  @php
                                    $total = 24;
                                  @endphp
                                @endif

                                @if($ticket->priority === 'prudente')
                                  <div class="label label-info">{{ ucfirst($ticket->priority) }}</div>
                                  @php
                                    $total = 48;
                                  @endphp
                                @endif

                                @if($ticket->priority === 'moderado')
                                  <div class="label label-success">{{ ucfirst($ticket->priority) }}</div>
                                  @php
                                    $total = 72;
                                  @endphp
                                @endif
                                
                                @if($ticket->priority === 'leve')
                                  <div class="label label-primary">{{ ucfirst($ticket->priority) }}</div>
                                  @php
                                    $total = 120;
                                  @endphp
                                @endif

                                @if($ticket->priority === 'premeditado')
                                  <div class="label label-default">{{ ucfirst($ticket->priority) }}</div>
                                  @php
                                    $total = 720;
                                  @endphp
                                @endif
                              </center>                          
                          </td>       

                          <td>
                            @php
                              $date1 = new DateTime(date('Y-m-d H:i:s'));
                              $date2 = new DateTime($ticket->fecha_atencion);
                              
                              $interval = new DateInterval('PT1H');                
                              $periods = new DatePeriod($date1, $interval, $date2);
                              $hours = iterator_count($periods);

                              $diferencia = $total - $hours;
                              $treinta = $total * 0.33;
                              $sesenta  = $total * 0.66;
                            @endphp

                            <center>
                              @if($diferencia < $treinta)
                                <div class="label label-success">{{ $hours . ' horas'}}</div>
                              @endif

                              @if($diferencia >= $treinta && $diferencia < $sesenta)
                                <div class="label label-warning">{{ $hours . ' horas'}}</div>
                              @endif

                              @if($diferencia >= $sesenta)
                                <div class="label label-danger">{{ $hours . ' horas'}}</div>
                              @endif
                            </center>

                          </td>                 

                          <td><center>
                            {{ ucwords(DB::table('users')->where('id', $ticket->user_id)->value('primer_nombre')) . " " . ucwords(DB::table('users')->where('id', $ticket->user_id)->value('primer_apellido'))}}
                            </center>                    
                          </td>                                    

                          <td><center>{{ $ticket->created_at->format('d-m-Y g:m a') }}</center></td>
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

<script>
  
  $(document).ready(function() {
    $('#datatable-responsive').DataTable( {
        "deferRender": true,
        "sScrollY": false,
        "order": [[ 3, "desc" ], [5, "desc"]],
    });


    setTimeout( function(){
       $('#datatable-responsive').DataTable().search( '' ).draw();
    }, 10 );
  });

  
</script>



@endsection