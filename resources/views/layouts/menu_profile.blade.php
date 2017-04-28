<div class="profile clearfix">
  <div class="profile_pic">
    <img src="images/{{ Auth::user()->name }}.jpg" alt="..." class="img-circle profile_img">
  </div>
  <div class="profile_info">
    <span>Bienvenido,</span>
    <h2>{{ Auth::user()->name }}</h2>
  </div>
</div>