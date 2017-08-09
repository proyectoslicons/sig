@extends('layouts.master')

@section('content')
    
    <div class="right_col" role="main">

      <div class="">
        <div class="page-title">
          <div class="title_left">
            <h3>Gestión de evaluaciones</h3>
          </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Registrar prima</h2>
                    <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" method="POST" action="{{ route('prima.store') }}">

                      {{ csrf_field() }}
                    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id">Colaborador <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_single form-control" id="user_id" name="user_id">

                            @foreach($departamentos as $departamento)

                            <optgroup label="{{ucwords($departamento->name)}}">
                              
                              @php                                                            
                                
                                $colaboradores = \App\User::where('departamento_id', $departamento->id)
                                ->orderByRaw('primer_nombre ASC, primer_apellido ASC')                                
                                ->get();

                              @endphp

                              @foreach($colaboradores as $colaborador)                          
                                <option value="{{$colaborador->id}}">{{ucwords($colaborador->primer_nombre . " " . $colaborador->primer_apellido)}}</option>
                              @endforeach

                            </optgroup>

                            @endforeach

                          </select>   
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prima">Prima <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" step="any" id="prima" min=0 required="required" class="form-control col-md-7 col-xs-12" name="prima">
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