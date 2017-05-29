@include('layouts.Toaster')

@if (count($errors) > 0)
  	<script>
		  toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": false,
		  "progressBar": false,
		  "positionClass": "toast-bottom-right",
		  "preventDuplicates": false,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "3000",
		  "extendedTimeOut": "500",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		  };

		  toastr["error"]("@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach", "Se han encontrado algunos errores.");
	</script>

@endif