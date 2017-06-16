<!DOCTYPE html>
<html lang="es">
  <head>    
    @include('layouts.head_content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  </head>

  <body class="nav-md footer_fixed" style="max-height: 1000px; overflow-x: hidden;">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            @include('layouts.navbar_title')

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
              @include('layouts.menu_profile')
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
              @include('layouts.sidebar')
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
              @include('layouts.menu_footer')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
          @include('layouts.nav')
        <!-- /top navigation -->

        <!-- page content -->
            @yield('content')
        <!-- /page content -->

        <!-- footer content -->
          @include('layouts.footer')
        <!-- /footer content -->
      </div>
    </div>

    @include('layouts.script')
    
  </body>
</html>
