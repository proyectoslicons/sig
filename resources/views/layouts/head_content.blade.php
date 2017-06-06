<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>LICONS - Sistema Integral de Gestión</title>

<!-- Bootstrap -->
<link href="{{ URL::asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{ URL::asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<!-- NProgress -->
<link href="{{ URL::asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">

<!-- Datatables -->
<link href="{{ URL::asset('vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="{{ URL::asset('css/bootstrap-datepicker3.css') }}" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="{{ URL::asset('build/css/custom.min.css') }}" rel="stylesheet">

<!-- jQuery -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>

<!-- boostrap datepicker -->
<script src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-datepicker.es.min.js') }}"></script>

<script>
// rename myToken as you like
window.Laravel =  <?php echo json_encode([
    'csrfToken' => csrf_token(),
]); ?>
</script>

