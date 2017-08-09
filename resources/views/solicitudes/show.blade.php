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

          <div class="row">

            <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="x_panel">
              <div class="x_title">
                <h2>Ticket - {{ $ticket->ticket_id }}</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                </ul>
                <div class="clearfix"></div>

                @include('layouts.errors')
                @include('layouts.success')
              
              </div>                  

              <div class="x_content">                            

                <div class="row">

                  <div class="col-md-12 col-xs-12 col-sm-12">
                          
                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Código de ticket:
                            </div>
                            <div style="margin-left: 150px; font-weight: bold; word-wrap: break-word;  "> 
                              {{ $ticket->ticket_id }}
                            </div>
                          </div>
                          <br>

                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Título:
                            </div>
                            <div style="margin-left: 150px; font-weight: bold; word-wrap: break-word; "> 
                              {{ ucfirst($ticket->title) }}
                            </div>
                          </div>
                          <br>

                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Solicitado por:
                            </div>
                            <div style="margin-left: 150px; font-weight: bold; word-wrap: break-word; "> 
                              {{ ucwords(DB::table('users')->where('id', $ticket->user_id)->value('primer_nombre')) . " " . ucwords(DB::table('users')->where('id', $ticket->user_id)->value('primer_apellido'))}} 
                            </div>
                          </div>
                          <br>

                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Atendido por:
                            </div>
                            <div style="margin-left: 150px; font-weight: bold; word-wrap: break-word; "> 
                              {{ ucwords(DB::table('users')->where('id', $ticket->user_assigned_id)->value('primer_nombre')) . " " . ucwords(DB::table('users')->where('id', $ticket->user_assigned_id)->value('primer_apellido'))}} 
                            </div>
                          </div>
                          <br>
                                                                        
                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Prioridad:
                            </div>
                            <div style="margin-left: 150px; font-weight: bold"> 
                              
                              @if($ticket->priority === 'inmediato')
                                <div class="label label-danger">{{ ucfirst($ticket->priority) }}</div>
                              @endif
                              
                              @if($ticket->priority === 'imperativo')
                                <div class="label label-warning">{{ ucfirst($ticket->priority) }}</div>
                              @endif

                              @if($ticket->priority === 'prudente')
                                <div class="label label-info">{{ ucfirst($ticket->priority) }}</div>
                              @endif

                              @if($ticket->priority === 'moderado')
                                <div class="label label-success">{{ ucfirst($ticket->priority) }}</div>
                              @endif
                              
                              @if($ticket->priority === 'leve')
                                <div class="label label-primary">{{ ucfirst($ticket->priority) }}</div>
                              @endif

                              @if($ticket->priority === 'premeditado')
                                <div class="label label-default">{{ ucfirst($ticket->priority) }}</div>
                              @endif
                              
                            </div>
                          </div>
                          <br>

                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Estatus:
                            </div>
                            <div style="margin-left: 150px; font-weight: bold"> 
                              
                              @if($ticket->status === 'Open')
                                <span class="label label-success">{{ "Abierto" }}</span>
                              @endif                                                          

                              @if($ticket->status === 'Closed')
                                <span class="label label-danger">{{ "Cerrado" }}</span>
                              @endif

                              @if($ticket->status === 'Pending')
                                <span class="label label-warning">{{ "Pendiente por Cerrar" }}</span>
                              @endif
                            </div>
                          </div>
                          <br>                          
                            
                          @php
                            if($ticket->priority === 'inmediato')
                              $total = 4;
                            
                            if($ticket->priority === 'imperativo')
                              $total = 24;
                            
                            if($ticket->priority === 'prudente')
                              $total = 48;
                            
                            if($ticket->priority === 'moderado')
                              $total = 72;
                            
                            if($ticket->priority === 'leve')
                              $total = 120;
                            
                            if($ticket->priority === 'premeditado')
                              $total = 720;
                                  
                            $date1 = new DateTime(date('Y-m-d H:i:s'));
                            $date2 = new DateTime($ticket->fecha_atencion);
                            
                            $interval = new DateInterval('PT1H');                
                            $periods = new DatePeriod($date1, $interval, $date2);
                            $hours = iterator_count($periods);

                            $diferencia = $total - $hours;
                            $treinta = $total * 0.33;
                            $sesenta  = $total * 0.66;
                          @endphp

                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Categoría:
                            </div>
                            <div style="margin-left: 150px; font-weight: bold"> 
                              {{ ucfirst($category->name) }}
                            </div>
                          </div>
                          <br>
                                                                                              
                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Horas de atención:
                            </div>
                            <div style="margin-left: 150px; font-weight: bold"> 
                              @if($diferencia < $treinta)
                                <div class="label label-success">{{ $hours . ' horas'}}</div>
                              @endif

                              @if($diferencia >= $treinta && $diferencia < $sesenta)
                                <div class="label label-warning">{{ $hours . ' horas'}}</div>
                              @endif

                              @if($diferencia >= $sesenta)
                                <div class="label label-danger">{{ $hours . ' horas'}}</div>
                              @endif
                            </div>
                          </div>
                          <br>
                                                                                                                        
                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Fecha de creación:
                            </div>
                            <div style="margin-left: 150px; font-weight: bold"> 
                              {{ ucfirst($ticket->created_at->diffForHumans()) }}
                            </div>
                          </div>
                          <br>       

                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Última actualización:
                            </div>
                            <div style="margin-left: 150px; font-weight: bold"> 
                              {{ ucfirst($ticket->updated_at->diffForHumans()) }}
                            </div>
                          </div>
                          <br>

                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Mensaje:
                            </div>                            

                            
                          </div>
                            
                              <textarea class="form-control" rows="5" style="width:100%;font-weight: bold;" readonly="true">{{ ucfirst($ticket->message) }}</textarea>
                            
                          <br>                          
                                                     
                  </div>

                </div>                
                
              </div>
              </div>
            </div>
            
            @php
              if($ticket->status !== 'Closed'){
            @endphp
                <div class="col-md-4 col-sm-12 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Enviar comentario</h2>
                      <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>                      
                      </ul>
                      <div class="clearfix"></div>
                    
                    </div>                  

                    <div class="x_content">                            

                      <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">

                          <form action="{{ url('comentar') }}" method="POST" class="form" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                <input type="hidden" name="ticket" value="{{$ticket->ticket_id}}">

                                <div class="form-group">
                                    <textarea rows="10" id="comment" class="form-control" name="comment" required></textarea>                                
                                </div>

                                <div class="form-group">
                                  <div style="top: 4px">
                                    <input type="file" name="archivos[]" id="archivos" multiple>
                                  </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Envíar</button>
                                </div>
                            </form>
                                                           
                        </div>


                        
                      </div>


                      
                    </div>


                  </div>
                </div>
            @php
              }
            @endphp
            
            @php
              if($ticket->status !== 'Closed'){
            @endphp
            
            
            <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Acciones</h2>
                  <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                      
                  </ul>
                  <div class="clearfix"></div>
                
                </div>                  

                <div class="x_content">                            

                  <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">                    

                    @if(Auth::id() === $ticket->user_default_id || Auth::id() === $ticket->user_assigned_id)

                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-delegar-modal-sm">Delegar Ticket</button>

                      <div class="modal fade bs-delegar-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Delegar Ticket</h4>
                            </div>

                            <form action="{{ url('delegarTicket') }}" method="POST">

                              <div class="modal-body">
                                
                                <div class="form-group">
                                
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_asignar">Colaborador
                                  </label>
                                  
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                    
                                    {{ csrf_field() }}

                                    <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">

                                    <select class="select2_single form-control" name="id_asignar" id="id_asignar">
                                      @foreach($empleados as $empleado)   
                                        <option value="{{$empleado->id}}">{{ ucwords($empleado->primer_nombre . " " . $empleado->primer_apellido)}}
                                        </option>
                                      @endforeach
                                    </select>

                                    <br>
                                  </div>
                                
                                </div>
                              
                              </div>
                              <br>
                              
                              <div class="modal-footer">
                                <center>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                  <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </center>
                              </div>
                            
                            </form>

                          </div>
                        </div>
                      </div>                                      
                      

                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-escalar-modal-sm">Escalar ticket</button>

                      <div class="modal fade bs-escalar-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Escalar ticket</h4>
                            </div>

                            <form action="{{ url('escalarTicket') }}" method="POST" enctype="multipart/form-data">
                              
                              {{ csrf_field() }}

                              <div class="modal-body">
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento_id">Unidad funcional
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">                                    

                                    <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">

                                    <select class="select2_single form-control" name="departamento_id" id="departamento_id">
                                      @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{ ucwords($department->name)}}
                                        </option>
                                      @endforeach
                                    </select>
                                    
                                    <br>

                                    </div>
                                    
                                    <div class="form-group">
                                      <div id="row">
                                        <div class="col-md-3">
                                          <label style="left: -9px" class="control-label col-md-3 col-sm-3 col-xs-12" for="mensaje_escalar">Mensaje
                                          </label>
                                        </div>
                                        <div class="col-md-9">
                                          <textarea rows="4" style="resize: none;" class="form-control"  name="mensaje_escalar"></textarea>
                                          <br>
                                        </div>
                                      </div>
                                    </div>
                                    
                                    <br><br>
                                    
                                </div>
                                    
                                    <div class="form-group" style="">
                                      <br><br>
                                      <label for="archivos" class="control-label col-md-3 col-sm-3 col-xs-12">Adjuntos</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12" style="top: 4px">
                                        <input type="file" name="archivos[]" id="archivos" multiple>
                                      </div>
                                    </div>

                                    <br><br><br><br> 
                                
                              </div>
                              <br>
                              <div class="modal-footer">
                                <center>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                  <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </center>
                              </div>

                            </form>

                          </div>
                        </div>
                      </div>

                    @endif

                    @if(Auth::id() === $ticket->user_id)
                      
                      <form action="{{ url('cerrarTicket') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">
                        <button type="submit" class="btn btn-danger">Cerrar ticket</button>
                      </form>

                      @php
                        if($ticket->status === 'Pending'){
                      @endphp
                          <form action="{{ url('reabrirTicket') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">
                            <button type="submit" class="btn btn-success">Reabrir ticket</button>
                          </form>
                      @php
                        }
                      @endphp

                    @endif

                    @if(Auth::id() === $ticket->user_default_id || Auth::id() === $ticket->user_assigned_id)
                      
                      @if($ticket->status !== 'Pending')
                        <form action="{{ url('ticketAtendido') }}" method="POST">
                          {{ csrf_field() }}
                          <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">
                          <button type="submit" class="btn btn-warning">Finalizar atención</button>
                        </form>
                      @endif

                    @endif

                    </div>
                    
                  </div>
                  
                </div>
              </div>
            </div>

            @php
              }
            @endphp

            <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Recorrido de atención</h2>
                  <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                      
                  </ul>
                  <div class="clearfix"></div>
                
                </div>                  

                <div class="x_content scrollbar" id="style-3">      
                @php  
                  $mes[1]  = 'Ene';
                  $mes[2]  = 'Feb';
                  $mes[3]  = 'Mar';  
                  $mes[4]  = 'Abr';
                  $mes[5]  = 'May'; 
                  $mes[6]  = 'Jun';
                  $mes[7]  = 'Jul'; 
                  $mes[8]  = 'Ago'; 
                  $mes[9]  = 'Sep'; 
                  $mes[10] = 'Oct'; 
                  $mes[11] = 'Nov';
                  $mes[12] = 'Dic';                                                        
                @endphp
                  @foreach($bitacora as $bit)
                    @php
                      $current = \App\User::where(['id' => $bit->user_id])->first();
                    @endphp

                    <article class="media event">
                      <a class="pull-left date" style="background-color: rgb(51, 204, 204)">
                        <p class="month">{{ $mes[$bit->created_at->month] }}</p>
                        <p class="day">{{ $bit->created_at->day }}</p>
                      </a>
                      <div class="media-body">
                        <a class="title" href="#">Acción:</a>
                        <p>{{ $bit->mensaje . " " . ucwords($current->primer_nombre . " " . $current->primer_apellido)}}</p>
                      </div>
                    </article>

                  @endforeach                                
                  
                </div>
              </div>
            </div>

          </div>

          <div class="x_panel">
              <div class="x_title">
                <h2>Archivos adjuntos</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                </ul>
                <div class="clearfix"></div>              
              </div>                  

              <div class="x_content scrollbar-attachments" id="style-3">                            
                <div class="row">                          
                  <div class="col-md-12 col-sm-12 col-xs-12">
                      
                    @if(count($attachments) > 0)                        
                      <table class="table table-striped">
                        <thead>
                          <tr style="background-color: rgb(51, 204, 204); color: white; font-weight: bold">
                            <th>#</th>
                            <th>Nombre del archivo</th>
                            <th>Subido por</th>                              
                          </tr>
                        </thead>
                        
                        <tbody>                                                
                            
                            @php 
                              $i = 1;                                
                            @endphp

                            @foreach ($attachments as $attachment)                                       
                              @php
                                $usuario = \App\User::find($attachment->user_id);
                                $nombre = ucwords($usuario->primer_nombre . " " . $usuario->primer_apellido);
                              @endphp

                              <tr>
                                <th scope="row">{{$i}}</th>

                                <td style="font-weight: bold;">                                
                                  <form id="arc{{$i}}" action="{{ url('descargarAdjunto') }}" method="POST" target="_blank">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="filename" value="{{$attachment->filename}}">
                                    <a href="javascript:{}" onclick="document.getElementById('arc{{$i}}').submit();">{{$attachment->filename}}</a>
                                  </form>
                                </td>

                                <td>{{$nombre}}</td>
                              </tr>
                              
                              @php
                                $i++;
                              @endphp                                                              
                            @endforeach                                               
                        </tbody>                      
                      </table>
                    @endif 

                    @if(count($attachments) == 0)
                      {{'No hay archivos adjuntos en éste ticket.'}}
                    @endif

                  </div>                                                 
                </div>                
              </div>                
          </div>              

          <div class="x_panel">
            <div class="x_title">
              <h2>Mensajes</h2>
              <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>                      
              </ul>
              <div class="clearfix"></div>
            
            </div>                  

            <div class="x_content scrollbar-comments" id="style-3">                            

              <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12">
                        
                   <div class="col-md-12 col-sm-12 col-xs-12">
                    @foreach ($comments as $comment)
                        <div class="col-md-12 col-sm-12 col-xs-12 panel panel-success">
                            <div class="panel panel-heading" style="background-color: rgb(51, 204, 204); color: white; font-weight: bold">
                                {{ ucwords($comment->user->primer_nombre . " " . $comment->user->primer_apellido) }}
                                <span class="pull-right">{{ $comment->created_at->format('d-m-Y g:i:s a') }}</span>
                            </div>

                            <div class="panel panel-body" style="background-color: #e6e6e6">
                                {{ ucfirst($comment->comment) }}     
                            </div>
                        </div>
                    @endforeach

                    @if(count($comments) === 0)
                      {{"No hay mensajes para éste ticket."}}
                    @endif
                </div>                               
                


                </div>
                
              </div>
              
            </div>              
          </div>        
      </div>



      </div>
      </div>
    </div>

    <script>
      function delegar(id){
        var req = { "asignar" : $("#delegar").val() };

        if(req.id != ""){
          $.ajax({
             url: '',
             type: 'PUT',
             data: req,
             success: function(response) {
               console.log(response);
             }
          });
        }
        else{
          alert("Delegar vacio");
        }
      }
    </script>
<br><br>
@endsection