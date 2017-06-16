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
                              Código de Ticket:
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

                              @if($ticket->status === 'Close')
                                <span class="label label-danger">{{ "Cerrado" }}</span>
                              @endif
                            </div>
                          </div>
                          <br>
                                                                                              
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
                              Fecha de Creación:
                            </div>
                            <div style="margin-left: 150px; font-weight: bold"> 
                              {{ ucfirst($ticket->created_at->diffForHumans()) }}
                            </div>
                          </div>
                          <br>       

                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Última Actualización:
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

            <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Enviar Mensaje</h2>
                  <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                      
                  </ul>
                  <div class="clearfix"></div>
                
                </div>                  

                <div class="x_content">                            

                  <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">

                      <form action="{{ url('comentar') }}" method="POST" class="form">
                            {{ csrf_field() }}

                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">

                            <div class="form-group">
                                <textarea rows="10" id="comment" class="form-control" name="comment" required></textarea>                                
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

                    @if(Auth::id() === $ticket->user_default_id)

                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-delegar-modal-sm">Delegar Ticket</button>

                      <div class="modal fade bs-delegar-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Delegar Ticket</h4>
                            </div>

                            <form action="{{ url('delegarTicket') }}">
                              <div class="modal-body">
                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="delegar">Colaborador
                                  </label>
                                  <div class="col-md-9 col-sm-6 col-xs-12">
                                    <select class="select2_single form-control" name="delegar" id="delegar">                              
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
                                  <button type="button" onclick="delegar()" class="btn btn-primary">Guardar Cambios</button>
                                </center>
                              </div>
                            </form>

                          </div>
                        </div>
                      </div>

                    @endif

                    @if(Auth::id() === $ticket->user_default_id || Auth::id() === $ticket->user_assigned_id)
                    
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-escalar-modal-sm">Escalar Ticket</button>

                      <div class="modal fade bs-escalar-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Escalar Ticket</h4>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="escalar">Unidad Funcional
                                </label>
                                <div class="col-md-9 col-sm-6 col-xs-12">
                                  <select class="select2_single form-control" name="escalar" id="escalar">                              
                                    @foreach($departments as $department)
                                      <option value="{{$department->id}}">{{ ucwords($department->name)}}
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
                                <button type="button" onclick="delegar()" class="btn btn-primary">Guardar Cambios</button>
                              </center>
                            </div>

                          </div>
                        </div>
                      </div>

                    @endif

                    @if(Auth::id() === $ticket->user_id)
                      
                      <form action="{{ url('cerrarTicket') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="ticket_id" value="{{ $ticket->ticket_id }}">
                        <button type="submit" class="btn btn-danger">Cerrar Ticket</button>
                      </form>

                    @endif

                    </div>
                    
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Recorrido de Atención</h2>
                  <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                      
                  </ul>
                  <div class="clearfix"></div>
                
                </div>                  

                <div class="x_content">      
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
                        <a class="title" href="#">Ticket enviado a:</a>
                        <p>El ticket se ha enviado a: {{ ucwords($current->primer_nombre . " " . $current->primer_apellido) }}</p>
                      </div>
                    </article>
                  @endforeach                                
                  
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

              <div class="x_content">                            

                <div class="row">

                  <div class="col-md-12 col-sm-12 col-xs-12">
                          
                     <div class="col-md-12 col-sm-12 col-xs-12">
                      @foreach ($comments as $comment)
                          <div class="col-md-12 col-sm-12 col-xs-12 panel panel-@if($ticket->user->id === $comment->user_id) {{"default"}}@else{{"success"}}@endif">
                              <div class="panel panel-heading" style="background-color: rgb(51, 204, 204); color: white; font-weight: bold">
                                  {{ ucwords($comment->user->primer_nombre . " " . $comment->user->primer_apellido) }}
                                  <span class="pull-right">{{ $comment->created_at->format('Y-m-d') }}</span>
                              </div>

                              <div class="panel panel-body" style="background-color: #e6e6e6">
                                  {{ ucfirst($comment->comment) }}     
                              </div>
                          </div>
                      @endforeach

                      @if(count($comments) === 0)
                        {{"No hay mensajes para este ticket."}}
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