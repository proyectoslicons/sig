    <!-- Bootstrap -->
    <script src="{{ URL::asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ URL::asset('vendors/nprogress/nprogress.js') }}"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="{{ URL::asset('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
    <script src="{{ URL::asset('vendors/google-code-prettify/src/prettify.js') }}"></script>
  
  <!-- SmartWizard -->
    <script src="{{ URL::asset('vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
  
  <!-- Datatables -->
    <script src="{{ URL::asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ URL::asset('vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ URL::asset('build/js/custom.min.js') }}"></script>

    <script>
      
      var cont = new Vue({
        el: '#app',

        data : {
            count : 0
        }                       

      });

      @php
        $arr = [
            'user_id' => Auth::id(),
            'status'  => 0
        ];
      @endphp

      cont.count = {{ App\Ticket_Notification::where($arr)->count() }};     

      var app = new Vue({
        el: '#root',
        
        data: {       
          notifications : []
        },

        methods:{
          addNotification(data){

            this.notifications.unshift(data);  
            cont.count++;   
            var audio = new Audio("{{ URL::asset('sound/notification.mp3') }}");
            audio.play();     

          }
        }
      });

      

      @php

        $notificaciones = App\Ticket_Notification::where($arr)                          
                          ->orderBy('created_at', 'desc')
                          ->take(5)
                          ->get();        
        
        foreach ($notificaciones as $noti) {
          $data = [];
          $data['nombre']     = $noti->nombre;
          $data['mensaje']    = $noti->mensaje;        
          $data['foto']       = $noti->foto;
          $data['ticket_id']  = "" . url('solicitudes/ticket') . "/" . $noti->ticket_id;
          $time               = strtotime($noti->created_at);
          $newformat          = date('d/m/Y', $time);
          $data['fecha']      = $newformat;
      
      @endphp

          app.notifications.push({
              'nombre'    : '{{ $data['nombre'] }}',
              'mensaje'   : '{{ $data['mensaje'] }}',
              'foto'      : '{{ $data['foto'] }}',
              'fecha'     : '{{ $data['fecha'] }}',
              'ticket_id' : '{{ $data['ticket_id'] }}',
            }
          );  

      @php  
        }

      @endphp

      channel.bind('ticket_created', function(data) {
        app.addNotification(data);
      });


      var cont2 = new Vue({
        el: '#app2',

        data : {
            count : 0
        }                       

      });

      cont2.count = {{ App\CommentNotification::where('user_id', Auth::id())->where('status', 0)->count() }};     

      var app2 = new Vue({
        el: '#root2',
        
        data: {       
          notifications : []
        },

        methods:{
          addNotification(data){

            this.notifications.unshift(data);  
            cont2.count++;   
            var audio = new Audio("{{ URL::asset('sound/notification.mp3') }}");
            audio.play();     

          }
        }
      });

      

      @php
        

        $notificaciones = App\CommentNotification::where('user_id', Auth::id())
                          ->where('status', 0)
                          ->orderBy('created_at', 'desc')
                          ->take(5)
                          ->get();        
        
        foreach ($notificaciones as $noti) {
          $data = [];
          $data['nombre']     = $noti->nombre;
          $data['mensaje']    = $noti->mensaje;        
          $data['foto']       = $noti->foto;
          $data['ticket_id']  = "" . url('solicitudes/ticket') . "/" . $noti->ticket_id;
          $time               = strtotime($noti->created_at);
          $newformat          = date('d/m/Y', $time);
          $data['fecha']      = $newformat;
      
      @endphp

          app2.notifications.push({
              'nombre'    : '{{ $data['nombre'] }}',
              'mensaje'   : '{{ $data['mensaje'] }}',
              'foto'      : '{{ $data['foto'] }}',
              'fecha'     : '{{ $data['fecha'] }}',
              'ticket_id' : '{{ $data['ticket_id'] }}',
            }
          );  

      @php  
        }

      @endphp



      channel2.bind('ticket_commented', function(data) {
        app2.addNotification(data);
      });
      
      console.clear();
    </script> 

    
