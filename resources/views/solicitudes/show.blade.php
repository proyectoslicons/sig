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
                              {{ ucwords(DB::table('users')->where('id', $ticket->user_id)->value('name')) }}
                            </div>
                          </div>
                          <br>
                                                                        
                          <div style="width:100%; font-size: 14px;">           
                            <div style="float:left;  color: rgb(51, 204, 204); font-weight: bold">
                              Prioridad:
                            </div>
                            <div style="margin-left: 150px; font-weight: bold"> 
                              
                              @if($ticket->priority === 'baja')
                                <span class="label label-info">{{ ucfirst($ticket->priority) }}</span>
                              @endif
                              
                              @if($ticket->priority === 'media')
                                <span class="label label-warning">{{ ucfirst($ticket->priority) }}</span>
                              @endif

                              @if($ticket->priority === 'alta')
                                <span class="label label-danger">{{ ucfirst($ticket->priority) }}</span>
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

                              @if($ticket->status === 'alta')
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
                  <h2>Delegar Atención</h2>
                  <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>                      
                  </ul>
                  <div class="clearfix"></div>
                
                </div>                  

                <div class="x_content">                            

                  <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                       
                    </div>
                    
                  </div>
                  
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

                  <div class="col-md-12">
                          
                     <div class="col-md-12">
                      @foreach ($comments as $comment)
                          <div class="col-md-12 col-sm-12 col-xs-12 panel panel-@if($ticket->user->id === $comment->user_id) {{"default"}}@else{{"success"}}@endif">
                              <div class="panel panel-heading" style="background-color: rgb(51, 204, 204); color: white; font-weight: bold">
                                  {{ $comment->user->name }}
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
<br><br>
@endsection