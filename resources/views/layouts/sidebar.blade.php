<div id="sidebar-menu" class="main_menu_side hidden-print ">

  <div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu ">      

      <li>
        <a href="{{ url('home') }}"><i class="fa fa-home"></i> Inicio</a>        
      </li>
      
    </ul>
  </div>

  <div class="menu_section">
    <h3>Libreta de contactos</h3>
    <ul class="nav side-menu ">      

      <li>
        <a href="{{ url('contactos') }}"><i class="fa fa-book"></i> Contactos</a>        
      </li>
      
    </ul>
  </div>

  @if(Auth::user()->is_admin || Auth::user()->departamento_id == 3)
    <div class="menu_section">
      <h3>Administración SIG</h3>
      <ul class="nav side-menu ">      

        <li><a><i class="fa fa-gears"></i> Parámetros del sistema <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">            
            <li><a href="{{ url('parametros/unidades') }}">Unidades funcionales</a></li>                                  
            <li><a href="{{ url('parametros/encargado') }}">Encargados unidades funcionales</a></li>                         
            <li><a href="{{ url('parametros/cargos') }}">Cargos</a></li>
            <li><a href="{{ url('parametros/paises') }}">Países</a></li>
            <li><a href="{{ url('parametros/estados') }}">Estados</a></li>
            <li><a href="{{ url('parametros/ciudades') }}">Ciudades</a></li> 
            <li><a href="{{ url('parametros/profesiones') }}">Profesiones</a></li>
          </ul>
        </li>

        <li><a href="{{ url('usuarios') }}"><i class="fa fa-users"></i> Gestión de usuarios</a></li>        
      </ul>
    </div>
  @endif

  @if(Auth::user()->departamento_id == 2)
    <div class="menu_section">
      <h3>Evaluaciones de Desempeño</h3>
      <ul class="nav side-menu ">      

        <li><a><i class="fa fa-bar-chart"></i> Gestión de evaluaciones <span class="fa fa-chevron-down"></span></a>
          <ul class="nav child_menu">
            <li><a href="{{ url('evaluaciones/instrumentos') }}">Lista de instrumentos</a></li>
            <li><a href="{{ url('evaluaciones/bono') }}">Bonos</a></li>
            <li><a href="{{ url('evaluaciones/prima') }}">Primas</a></li>
            <li><a href="{{ url('evaluaciones/target') }}">Target</a></li>
            <li><a href="{{ url('evaluaciones/evaluacion') }}">Evaluación</a></li>
          </ul>
        </li> 
        
      </ul>
    </div>
  @endif


  <div class="menu_section">
    <h3>Gestión de solicitudes</h3>
    <ul class="nav side-menu ">      

      <li><a><i class="fa fa-ticket"></i> Gestión de tickets <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ url('solicitudes/listarTickets') }}">Lista de tickets</a></li>
          <li><a href="{{ url('solicitudes/crearTicket') }}">Abrir ticket</a></li>
          
          @php
            $departamento_usuario = App\Department::where('id', Auth::user()->departamento_id)->First();
          @endphp
          
          @if(Auth::user()->is_admin || Auth::user()->id == $departamento_usuario->id_department_head)
            <li><a href="{{ url('solicitudes/categorias') }}">Categorías</a></li>
          @endif
        </ul>
      </li> 
      
    </ul>
  </div>

</div>