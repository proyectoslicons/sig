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

<script src="https://js.pusher.com/4.0/pusher.min.js"></script>
<script src="{{ URL::asset('build/js/vue.js') }}"></script>

<script>
// rename myToken as you like
window.Laravel =  <?php echo json_encode([
    'csrfToken' => csrf_token(),
]); ?>

</script>

<style type="text/css">
	.scrollbar{
		max-height: 340px;	
		overflow-y: auto;
		overflow-x: hidden;
	}

	.scrollbar-comments{
		max-height: 500px;	
		overflow-y: auto;
		overflow-x: hidden;
	}

	.scrollbar-attachments{
		max-height: 150px;	
		overflow-y: auto;
		overflow-x: hidden;
	}

	#style-3::-webkit-scrollbar-track{
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
		background-color: #F5F5F5;
	}

	#style-3::-webkit-scrollbar{
		width: 6px;
		background-color: #F5F5F5;
	}

	#style-3::-webkit-scrollbar-thumb
	{
		background-color: rgb(51, 204, 204);
	}
	

</style>

