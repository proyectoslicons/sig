<script>      

  var pusher = new Pusher('dd41cdbc530d473d6e24', {
    encrypted: true
  });

  var channel = pusher.subscribe('app-ticket-' + {{ Auth::id() }} );    
  
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
                if(res[4] == 'logo.png')
                  $('#logo').attr('src', '{{ URL::asset('img/mini.png') }}');
                else
                  $('#logo').attr('src', '{{ URL::asset('img/logo.png') }}');
            }
          );          
        </script>

      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ URL::asset('images/'.Auth::user()->cedula.Auth::user()->primer_nombre.' '. Auth::user()->primer_apellido.'.jpg') }}" alt="">{{ Auth::user()->primer_nombre.' '. Auth::user()->primer_apellido }}
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            
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

                    <span class="image"><img :src="noti.foto" alt="Profile Image" />
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


        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-comments"></i>
            <span class="badge bg-green">6</span>
          </a>
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <li>
              <a>
                <span class="image"><img src="images/img.jpg" alt="Profile Image"></span>
                <span>
                  <span>John Smith</span>
                  <span class="time">3 mins ago</span>
                </span>
                <span class="message">
                  Film festivals used to be do-or-die moments for movie makers. They were where...
                </span>
              </a>
            </li>                    
          </ul>
        </li>

      </ul>
    </nav>
  </div>
</div>



