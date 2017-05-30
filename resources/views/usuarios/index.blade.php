@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Gestión de Usuarios</h3>
          </div>
        </div>

        <div class="clearfix"></div>

        @include('layouts.errors')
        @include('layouts.success')

        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
              <div class="x_title">
                <h2>Registrar Usuarios</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                </ul>
                <div class="clearfix"></div>
              </div>                  

              <div class="x_content">                  
                  <a href="{{ route('usuarios.create') }}" class="btn btn-success" style="background-color: rgb(51, 204, 204)"><i class="fa fa-plus-circle"></i> Registrar Usuario</a>
              </div>
            </div>


            <div class="x_panel">
              <div class="x_title">
                <h2>Lista de Usuarios</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                </ul>
                <div class="clearfix"></div>
              </div>                  

              <div class="x_content">                  
                <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%">
                  <thead>
                    <tr style="background-color: rgb(51, 204, 204)">
                      <th style="width: 33%">Nombre</th>
                      <th style="width: 33%">Email</th>
                      <th style="width: 33%">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
                    
      </div>
      </div>
      </div>
    </div>
<br><br>

<script>
    

    function preguntar(){
        return confirm("¿Desea eliminar el usuario?");
    }

    $(document).ready(function() {  

      $('#datatable-responsive').DataTable( {
          "processing": false,
          "serverSide": true,
          "ajax": "/api/users",
          "columns" : [
              {data: 'name'},
              {data: 'email'},
              {
                name: 'actions',
                data: null,
                sortable: false,
                searchable: false,
                render: function (data) {
                    var actions = '';
                    actions += '<a class="btn btn-warning col-sm-3 col-xs-5 btn-margin btn-xs" href="{{ route('usuarios.edit', ':id') }}"> Editar</a>';
                    actions += '<a class="btn btn-danger col-sm-3 col-xs-5 btn-margin btn-xs" href="{{ route('usuarios.destroy', ':id') }}" onclick="return preguntar()"> Eliminar</a>';
                    return actions.replace(/:id/g, data.id);
                }
              }
          ]
      });
    });

</script>

@endsection