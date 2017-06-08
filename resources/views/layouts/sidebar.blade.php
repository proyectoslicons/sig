<div id="sidebar-menu" class="main_menu_side hidden-print ">
  <div class="menu_section">
    <h3>Administración</h3>
    <ul class="nav side-menu ">      

      <li><a><i class="fa fa-gears"></i> Parámetros del Sistema <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ url('parametros/unidades') }}">Unidades Funcionales</a></li>
          <li><a href="{{ url('parametros/cargos') }}">Cargos</a></li>
          <li><a href="{{ url('parametros/paises') }}">Países</a></li>
          <li><a href="{{ url('parametros/estados') }}">Estados</a></li>
          <li><a href="{{ url('parametros/ciudades') }}">Ciudades</a></li> 
          <li><a href="{{ url('parametros/profesiones') }}">Profesiones</a></li>          
        </ul>
      </li>

      <li><a href="{{ url('usuarios') }}"><i class="fa fa-users"></i> Gestión de Usuarios</a>
      </li>
      
    </ul>
  </div>

  <div class="menu_section">
    <h3>Gestión de Solicitudes</h3>
    <ul class="nav side-menu ">      

      <li><a><i class="fa fa-ticket"></i> Gestión de Tickets <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ url('solicitudes/listarTickets') }}">Lista de Tickets</a></li>
          <li><a href="{{ url('solicitudes/crearTicket') }}">Abrir Ticket</a></li>
          <li><a href="{{ url('solicitudes/categorias') }}">Categorías</a></li>
        </ul>
      </li> 
      
    </ul>
  </div>

</div>