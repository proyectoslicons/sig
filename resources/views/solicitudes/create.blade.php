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
                    <h2>Abrir ticket</h2>
                    <ul class="nav navbar-right panel_toolbox" style="margin-right: -50px">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                                      

                    @include('layouts.errors')
                    @include('layouts.success')                  

                    <form class="form-horizontal form-label-left" method="POST" action="{{ url('/solicitudes/nuevo_ticket') }}" enctype="multipart/form-data">

                      {{ csrf_field() }}
                    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Título <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="title" class="form-control col-md-7 col-xs-12" name="title" autofocus required="required">
                        </div>
                      </div>
                    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department">Unidad funcional <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="department" class="select2_single form-control" name="department" required="required">
                            <option value="">Seleccionar unidad funcional</option>
                            @foreach($departments as $department)
                              <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>                     

                      <div class="form-group">
                        <label for="priority" class="control-label col-md-3 col-sm-3 col-xs-12">Tipo <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">                        
                          <select id="tipo" required="required" class="form-control" name="tipo">
                              <option value="">Seleccionar tipo</option>
                              <option value="0">Público</option>
                              <option value="1">Privado</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Categoría <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="category" class="select2_single form-control" name="category" required="required">
                            <option value="">Seleccionar categoría</option>
                            @foreach($categories as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="priority" class="control-label col-md-3 col-sm-3 col-xs-12">Prioridad <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">                        
                          <select id="priority" type="" class="form-control" name="priority" required="required">
                              <option value="">Seleccionar prioridad</option>
                              <option value="inmediato">Inmediato - hasta   4 horas</option>
                              <option value="imperativo">Imperativo - hasta  24 horas</option>
                              <option value="prudente">Prudente - hasta  48 horas</option>
                              <option value="moderado">Moderado - hasta  72 horas</option>
                              <option value="leve">Leve - hasta 120 horas</option>
                              <option value="premeditado">Premeditado - hasta 720 horas</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="message" class="control-label col-md-3 col-sm-3 col-xs-12">Mensaje <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea rows="10" id="message" class="form-control" name="message" style="resize: none;" required="required"></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="archivos" class="control-label col-md-3 col-sm-3 col-xs-12">Adjuntos</label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="top: 4px">
                          <input type="file" name="archivos[]" id="archivos" multiple>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-5 col-xs-offset-5">
                          <button type="submit" class="btn btn-success">Abrir ticket</button>
                        </div>
                      </div>

                    </form>                    

                  </div>
                </div>
              </div>
            </div>
      </div>
    </div>
<br><br>
  
  {{ csrf_field() }}

  <script>
      
      $('#department').change(function(){                                                              
        var id = $('#department').val();
        
        var datos = {'department_id' : id, '_token' : $('input[name=_token]').val()};

        $.post('/categoriasDepartamento', datos, function(data){
            
            $('#category').empty();
            for(i = 0; i < data.length; i++){
               
                var string = data[i].name;
                var categoria = string.charAt(0).toUpperCase() + string.slice(1);                                
                $('#category').append("<option value='" + data[i].id +"'>" + categoria + "</option>");
                
            }

            if(data.length == 0){
              $('#category').append("<option value=''>Seleccionar Prioridad</option>");              
            }

        });

      });

  </script>

@endsection