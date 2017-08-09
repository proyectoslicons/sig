@extends('layouts.master')

@section('content')
    
    

    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Gestión de Evaluaciones</h3>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Editar Dimensión</h2>
                    <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('dimension.update', ['id' => $dimension->id]) }}">

                      <input type="hidden" name="_method" value="PATCH">
                      {{ csrf_field() }}

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="unidad">Unidad Funcional
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input disabled="disabled" type="text" id="unidad" required="required" class="form-control col-md-7 col-xs-12" name="unidad" value="{{ ucfirst($unidad_funcional->name) }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cargo">Cargo
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input disabled="disabled" type="text" id="cargo" required="required" class="form-control col-md-7 col-xs-12" name="cargo" value="{{ ucfirst($cargo->name) }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="instrumento">Instrumento
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input disabled="disabled" type="text" id="instrumento" required="required" class="form-control col-md-7 col-xs-12" name="instrumento" value="{{ ucfirst($instrumento->descripcion) }}">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dimension">Dimensión <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="dimension" required="required" class="form-control col-md-7 col-xs-12" name="dimension" value="{{ ucfirst($dimension->descripcion) }}">
                        </div>
                      </div> 

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="porcentaje">Porcentaje <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" step="any" id="porcentaje" min=0 max=100 required="required" class="form-control col-md-7 col-xs-12" name="porcentaje" value="{{ $dimension->porcentaje }}">
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