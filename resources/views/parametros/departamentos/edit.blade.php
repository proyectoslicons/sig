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

        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar Usuario</h2>
                    <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('usuarios.update', ['id' => $user->id]) }}">

                      <input type="hidden" name="_method" value="PATCH">
                      {{ csrf_field() }}


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" required="required" class="form-control col-md-7 col-xs-12" name="name" value="{{ $user->name }}">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="{{ $user->email }}">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" class="form-control col-md-7 col-xs-12" type="password" name="password">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="password-confirm" class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar Contraseña</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password_confirmation" class="form-control col-md-7 col-xs-12" type="password" name="password_confirmation">
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5 col-xs-offset-5">
                          <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                      </div>

                    </form>

                    @include('layouts.errors')

                  </div>
                </div>
              </div>
            </div>
      </div>
    </div>
<br><br>
@endsection