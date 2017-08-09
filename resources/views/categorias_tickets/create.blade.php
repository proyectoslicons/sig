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

        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Registrar categoría</h2>
                    <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" method="POST" action="{{ route('categorias.store') }}">

                      {{ csrf_field() }}
                      
                      @if(Auth::user()->is_admin)
                        <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department">Unidad funcional <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="select2_single form-control" name="department" required="required">
                              <option value="">Seleccionar unidad funcional</option>
                              @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      @else
                        <input type="hidden" name="department" value="{{ Auth::user()->departamento_id }}">
                      @endif

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre de la categoría<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" class="form-control col-md-7 col-xs-12" name="name" autofocus>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5 col-xs-offset-5">
                          <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
                      </div>

                    </form>

                    @include('layouts.errors')
                    @include('layouts.success')

                  </div>
                </div>
              </div>
            </div>
      </div>
    </div>
<br><br>
@endsection