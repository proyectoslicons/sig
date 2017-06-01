<div class="profile clearfix">
  <div class="profile_pic">

    <img src="{{ URL::asset('images/'.Auth::user()->primer_nombre.' ' . Auth::user()->primer_apellido. '.jpg') }}" alt="..." class="img-circle profile_img">
  </div>
  <div class="profile_info">
    <span>Bienvenido,</span>
    <h2>{{ Auth::user()->primer_nombre.' '. Auth::user()->primer_apellido }}</h2>
  </div>
</div>