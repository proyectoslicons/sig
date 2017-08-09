<div class="profile clearfix">
  <div class="profile_pic">

	@php
		$myfile = 'images/'.Auth::user()->imagen;
        
		if (File::exists($myfile)){

	@endphp    	
			<img src="{{ URL::asset($myfile) }}" alt="..." class="img-circle profile_img">
	@php
		}
		else{			
			$myfile = 'images/user.png';
	@endphp
			<img src="{{ URL::asset($myfile) }}" alt="..." class="img-circle profile_img">
	@php
		}
	@endphp
    
  </div>
  <div class="profile_info">
    <span>Bienvenido,</span>
    <h2>{{ Auth::user()->primer_nombre.' '. Auth::user()->primer_apellido }}</h2>
  </div>
</div>