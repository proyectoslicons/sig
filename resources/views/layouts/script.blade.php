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
      })

    </script>

    <script>

      var app = new Vue({
        el: '#root',
        
        data: {       
          notifications : []
        },

        methods:{
          addNotification(data){

            this.notifications.push(data);  
            cont.count++;   
            var audio = new Audio("{{ URL::asset('sound/notification.mp3') }}");
            audio.play();     

          }
        }
      });
      
      channel.bind('ticket_created', function(data) {
        app.addNotification(data);
      });
      
    </script> 

    
