@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Gestión de solicitudes</h3>
          </div>
        </div>

        <div class="clearfix"></div>

        @include('layouts.errors')
        @include('layouts.success')

        <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
              <div class="x_title">
                <h2>Registrar categoría</h2>
                <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>                      
                </ul>
                <div class="clearfix"></div>
              </div>                  

              <div class="x_content">                  
                  <a href="{{ route('categorias.create') }}" class="btn btn-success" style="background-color: rgb(51, 204, 204)"><i class="fa fa-plus-circle"></i> Registrar categoría</a>
              </div>
            </div>


            <div class="x_panel">
              <div class="x_title">
                <h2>Lista de categorías</h2>
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
                      <th style="width: 33%">Unidad Funcional</th>
                      <th style="width: 33%">Nombre de la Categoría</th>
                      <th style="width: 33%">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>

                    @php                                           
                  
                      foreach ($categorias as $pos){
                        $departamento = App\Department::where('id', $pos->department_id)->First();
                  
                    @endphp
                  
                      <tr>                  
                        <td>{{ ucfirst($departamento->name) }}</td>
                        <td>{{ ucfirst($pos->name) }}</td>
                        <td>

                          <a href="{{ route('categorias.edit', ['id' => $pos->id]) }}" class="btn btn-warning col-sm-9 col-xs-6 btn-margin btn-xs" style="margin-left: 5px; margin-right: 5px;">
                            Editar
                          </a>                               

                        </td>
                      </tr>
                    
                    @php                        
                        
                        }
                      
                    @endphp
                  
                  </tbody>
                </table>
              </div>
            </div>
                    
      </div>
      </div>
      </div>
    </div>
<br><br>
@endsection