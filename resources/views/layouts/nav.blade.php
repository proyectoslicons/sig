<script>      

  var pusher = new Pusher('dd41cdbc530d473d6e24', {
    encrypted: true
  });

  var channel = pusher.subscribe('app-ticket-' + {{ Auth::id() }} );

  var channel2 = pusher.subscribe('app-comments-' + {{ Auth::id() }} );    
  
</script>

<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        
        <script>
          $('#menu_toggle').click(
            function() {
                var str = "" + $('#logo').attr('src');
                var res = str.split('//');
                str = res[1];
                res = str.split('/');
                if(res[2] == 'logo.png'){
                  $('#logo').attr('style','width: 68%');
                  $('#logo').attr('src', '{{ URL::asset('img/mini.png') }}');                  
                }
                else{
                  $('#logo').attr('src', '{{ URL::asset('img/logo.png') }}');
                  $('#logo').attr('style','width: 90%');
                }
            }
          );          
        </script>

      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            
            @php
              $myfile = 'images/'.Auth::user()->imagen;

              if (File::exists($myfile)){
            @endphp                     
                <img src="{{ URL::asset($myfile) }}" alt="">{{ ucwords(Auth::user()->primer_nombre.' '. Auth::user()->primer_apellido) }}
            @php
              }
              else{
                  $myfile = 'images/user.png';
            @endphp                  
                  <img src="{{ URL::asset($myfile) }}" alt="">{{ ucwords(Auth::user()->primer_nombre.' '. Auth::user()->primer_apellido) }}
            @php
              }
              
            @endphp
            
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            
            <li>
              <a href="{{ url('perfil') }}"><i class="fa fa-key pull-right"></i>Cambiar contraseña</a>  
            </li>

            <li><a href="{{ route('logout') }}" 
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out pull-right"></i>Salir</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>

          </ul>
        </li>

        <!Tickets>
        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" >
            
              <i class="fa fa-ticket"></i>
              <div id="app">
                <span class="badge bg-green" v-text="count"></span>
              </div>
            
          </a>
          
            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
              <div id="root">
                <li v-for="noti in notifications">

                  <a v-bind:href="noti.ticket_id">

                    <span class="image"><img :src="noti.foto"/>
                    </span>
                    
                    <span>                      
                      <span v-text="noti.nombre"></span>
                      <span class="time" v-text="noti.fecha"></span>
                    </span>

                    <span class="message" v-text="noti.mensaje"></span>

                  </a>
                </li>
              </div>

              <li>
                <div class="text-center">
                  <a href="{{ url('solicitudes/listarTickets') }}">
                    <strong>Ver todos los tickets</strong>
                    <i class="fa fa-angle-right"></i>
                  </a>
                </div>
              </li>

            </ul>          
        </li>
        
        <!comentarios>
        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" >
            
              <i class="fa fa-comments"></i>
              <div id="app2">
                <span class="badge bg-green" v-text="count"></span>
              </div>
            
          </a>          
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <div id="root2">
              <li v-for="noti in notifications">

                <a v-bind:href="noti.ticket_id">

                  <span class="image"><img :src="noti.foto"/>
                  </span>
                  
                  <span>                      
                    <span v-text="noti.nombre"></span>
                    <span class="time" v-text="noti.fecha"></span>
                  </span>

                  <span class="message" v-text="noti.mensaje"></span>

                </a>
              </li>
            </div>              
          </ul>
        </li>
        
        <!tickets con retraso>

        @php
            
          $arr = [
            ['user_id', '=', Auth::id()],
            ['status', 'LIKE', 'Pending']
          ];

          $ticket_porcerrar = \App\Ticket::where($arr)->get();          

          $arr = [
            ['user_assigned_id', '=', Auth::id()],
            ['status', 'LIKE', 'Open']              
          ];

          $ticket_retraso = \App\Ticket::where($arr)->get();
          $conteo_tickets_retraso = 0;
          
          foreach ($ticket_retraso as $t_retrasado) {
            $date1 = new DateTime(date('Y-m-d H:i:s'));
            $date2 = new DateTime($t_retrasado->fecha_atencion);
            
            $interval = new DateInterval('PT1H');                
            $periods = new DatePeriod($date1, $interval, $date2);
            $hours = iterator_count($periods);  

            if($hours <= 0){
              $conteo_tickets_retraso++;
            }
          }

        @endphp

        @if(count($ticket_porcerrar) > 0 || $conteo_tickets_retraso > 0)
          
          <li role="presentation" class="dropdown">
            <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" >            
                <i class="fa fa-clock-o"></i>
                
                <div>
                  <span class="badge bg-red">{{ ($conteo_tickets_retraso + count($ticket_porcerrar)) }}</span>
                </div>            
            </a>                                        
            
            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
              <div>
                
                @foreach($ticket_porcerrar as $t_cerrar)
                  <li>
                    <a href="{{ url('solicitudes/ticket/'. $t_cerrar->ticket_id) }}">
                      <span class="image"><i class="fa fa-ticket"></i>
                      </span>
                      
                      <span>                      
                        <span></span>
                        <span class="time">{{ $t_cerrar->fecha_atencion }}</span>
                      </span>

                      <span class="message">{{ 'El ticket '. $t_cerrar->ticket_id .' está pendiente por cerrar' }}</span>
                    </a>
                  </li>
                @endforeach

                @foreach($ticket_retraso as $t_retrasado)
                  
                  @php 

                    $date1 = new DateTime(date('Y-m-d H:i:s'));
                    $date2 = new DateTime($t_retrasado->fecha_atencion);
                    
                    $interval = new DateInterval('PT1H');                
                    $periods = new DatePeriod($date1, $interval, $date2);
                    $hours = iterator_count($periods);  

                    if($hours <= 0){
                      
                  @endphp
                  
                  <li>
                    <a href="{{ url('solicitudes/ticket/'. $t_retrasado->ticket_id) }}">
                      <span class="image"><i class="fa fa-ticket"></i>
                      </span>
                      
                      <span>                      
                        <span></span>
                        <span class="time">{{ $t_retrasado->fecha_atencion }}</span>
                      </span>

                      <span class="message">{{ 'La atención del ticket '. $t_retrasado->ticket_id .' está retrasada.' }}</span>
                    </a>
                  </li>
                  
                  @php
                    }
                  @endphp 
                @endforeach

              </div>              
            </ul>
          </li>

        @endif

        <!tickets con retraso>
      </ul>
    </nav>
  </div>
</div>



