@extends('layouts.master')

@section('content')
    
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Libreta de contactos</h3>
              </div>      

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input id="buscar" type="text" class="form-control" onkeypress="buscarEnter(event)" placeholder="Contacto a buscar...">
                    <span class="input-group-btn">
                      <button id="busqueda" class="btn btn-default" type="button" onclick="busqueda()">Buscar</button>
                    </span>
                  </div>
                </div>
              </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div id="master" class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <ul class="pagination pagination-split">
                          <li><a onclick="LoadContacts()" value="a">A</a></li>
                          <li><a onclick="LoadContacts()" value="b">B</a></li>
                          <li><a onclick="LoadContacts()" value="c">C</a></li>
                          <li><a onclick="LoadContacts()" value="d">D</a></li>
                          <li><a onclick="LoadContacts()" value="e">E</a></li>
                          <li><a onclick="LoadContacts()" value="f">F</a></li>
                          <li><a onclick="LoadContacts()" value="g">G</a></li>
                          <li><a onclick="LoadContacts()" value="h">H</a></li>
                          <li><a onclick="LoadContacts()" value="i">I</a></li>
                          <li><a onclick="LoadContacts()" value="j">J</a></li>
                          <li><a onclick="LoadContacts()" value="k">K</a></li>
                          <li><a onclick="LoadContacts()" value="l">L</a></li>
                          <li><a onclick="LoadContacts()" value="m">M</a></li>
                          <li><a onclick="LoadContacts()" value="n">N</a></li>
                          <li><a onclick="LoadContacts()" value="o">O</a></li>
                          <li><a onclick="LoadContacts()" value="p">P</a></li>
                          <li><a onclick="LoadContacts()" value="q">Q</a></li>
                          <li><a onclick="LoadContacts()" value="r">R</a></li>
                          <li><a onclick="LoadContacts()" value="s">S</a></li>
                          <li><a onclick="LoadContacts()" value="t">T</a></li>
                          <li><a onclick="LoadContacts()" value="u">U</a></li>
                          <li><a onclick="LoadContacts()" value="v">V</a></li>
                          <li><a onclick="LoadContacts()" value="w">W</a></li>
                          <li><a onclick="LoadContacts()" value="x">X</a></li>
                          <li><a onclick="LoadContacts()" value="y">Y</a></li>
                          <li><a onclick="LoadContacts()" value="z">Z</a></li>
                        </ul>
                      </div>

                      <div class="clearfix"></div>
                      
                      @foreach($contactos as $contacto)
                        @php

                          $corporativo = "";
                          $extension = "";

                          if($contacto->telefono_corporativo === NULL)
                            $corporativo = "No posee";
                          else
                            $corporativo = $contacto->telefono_corporativo;

                          if($contacto->extension === NULL)
                            $extension = "No posee";
                          else
                            $extension = $contacto->extension;

                          $cargo = \App\Position::where('id', $contacto->cargo_id)->First();
                          $departamento = \App\Department::where('id', $contacto->departamento_id)->First();
                        @endphp
                        
                        <div class="col-md-4 col-sm-4 col-xs-12 profile_details contacto">
                          <div class="well profile_view">
                            <div class="col-sm-12">
                              <h4 class="brief"><i><strong>{{ ucfirst($cargo->name) }}</strong></i></h4>
                              <div class="left col-xs-7">
                                <h2>{{ ucwords($contacto->primer_nombre . " " . $contacto->primer_apellido) }}</h2>
                                <p><i style='color: rgb(51, 204, 204)' class='fa fa-phone'></i><strong style='color: rgb(51, 204, 204)'> Teléfono: </strong> <br>{{ $contacto->telefono_movil }} </p>
                                <ul class="list-unstyled">
                                  <li><i style='color: rgb(51, 204, 204)' class="fa fa-phone"></i> <strong style='color: rgb(51, 204, 204)'>Teléfono corporativo: </strong>{{ $corporativo }}</li>
                                  <li><i style='color: rgb(51, 204, 204)' class="fa fa-phone"></i> <strong style='color: rgb(51, 204, 204)'>Extensión: </strong>{{ $extension }}</li>
                                  <li><i style='color: rgb(51, 204, 204)' class="fa fa-envelope"></i> <strong style='color: rgb(51, 204, 204)'>Correo: </strong>{{ $contacto->email }}</li>
                                </ul>
                              </div>
                              <div class="right col-xs-5 text-center">
                                
                                @php
                                  $myfile = 'images/'.$contacto->imagen;

                                  if (File::exists($myfile)){
                                @endphp     
                                    <img src="{{ URL::asset($myfile) }}" class="img-circle img-responsive">
                                @php
                                  }                                  
                                  else{
                                      $myfile = 'images/user.png';
                                @endphp
                                      <img src="{{ URL::asset($myfile) }}" class="img-circle img-responsive">
                                @php                                    
                                  }
                                @endphp

                                
                              </div>
                            </div>
                            <div class="col-xs-12 bottom text-center">
                              <div class="col-xs-12 col-sm-6 emphasis">
                                
                              </div>
                              <div class="col-xs-12 col-sm-12 emphasis">
                                <strong>{{ ucfirst($departamento->name) }}</strong>
                              </div>
                            </div>
                          </div>
                        </div>
                                              
                      @endforeach

                        <span class="carga"></span> 
                         

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{ csrf_field() }}

        <script>
          
          function LoadContacts(){
            var letra = $(event.target).attr('value');

            @php 
              $cargos = App\Position::get(['id', 'name']);
              $car = [];
              $car2 = [];
              
              foreach ($cargos as $cargo) {
                $car2 = [
                  'id'    => $cargo->id,
                  'name'  => $cargo->name
                ];
                
                array_push($car, $car2);
              }

              $departamentos = App\Department::get(['id', 'name']);
              $dep = [];
              $dep2 = [];
              
              foreach ($departamentos as $departamento) {
                $dep2 = [
                  'id'    => $departamento->id,
                  'name'  => $departamento->name
                ];
                
                array_push($dep, $dep2);
              } 
            @endphp

            var cargos = 
              @php 
                echo json_encode($car); 
              @endphp
            ;

            var departamentos = 
              @php 
                echo json_encode($dep); 
              @endphp
            ;                                  

            $(".contacto").remove();                                    
                                                            
            var datos = {'letra' : letra, '_token' : $('input[name=_token]').val()};

            var image_url = '';

            var direccion_base =  '{{ URL::asset('images') }}';            
            
            var string = "";
            
            $.post('buscarContactos', datos, function(data){                    
                var cargo = "";
                var departamento = "";
                var corporativo = "";
                var extension = "";

                for(var i = 0; i < data.length; i++){ 
                  if(data[i].telefono_corporativo === null)
                    corporativo = "No posee";
                  else
                    corporativo = data[i].telefono_corporativo;

                  if(data[i].extension === null)
                    extension = "No posee";
                  else
                    extension = data[i].extension;

                  for(var j = 0; j < cargos.length; j++){

                    if(data[i].cargo_id == cargos[j].id){
                      cargo = cargos[j].name;
                    }

                  }

                  for(var j = 0; j < departamentos.length; j++){

                    if(data[i].departamento_id == departamentos[j].id){
                      departamento = departamentos[j].name;                      
                    }

                  }

                  image_url = direccion_base + "/" + data[i].imagen;
                  
                  string += "<div class='col-md-4 col-sm-4 col-xs-12 profile_details contacto'>"+
                          "<div class='well profile_view'>"+
                            "<div class='col-sm-12'>"+
                              "<h4 class='brief'><i><strong>"+ cargo +"</strong></i></h4>"+
                              "<div class='left col-xs-7'>"+
                                "<h2>"+ data[i].primer_nombre + " " + data[i].primer_apellido  +"</h2>"+
                                "<p><i style='color: rgb(51, 204, 204)' class='fa fa-phone'></i><strong style='color: rgb(51, 204, 204)'> Teléfono: </strong> <br>"+ data[i].telefono_movil +" </p>"+
                                "<ul class='list-unstyled'>"+
                                  "<li><i style='color: rgb(51, 204, 204)' class='fa fa-phone'></i> <strong style='color: rgb(51, 204, 204)'>Teléfono corporativo: </strong>"+ corporativo +"</li>"+
                                  "<li><i style='color: rgb(51, 204, 204)' class='fa fa-phone'></i> <strong style='color: rgb(51, 204, 204)'>Extensión: </strong>"+ extension +"</li>"+
                                  "<li><i style='color: rgb(51, 204, 204)' class='fa fa-envelope'></i> <strong style='color: rgb(51, 204, 204)'>Correo: </strong>"+ data[i].email +"</li>"+
                                "</ul>"+
                              "</div>"+
                              "<div class='right col-xs-5 text-center'>"+                                
                                    "<img src='"+ image_url +"' class='img-circle img-responsive'>"+
                              "</div>"+
                            "</div>"+
                            "<div class='col-xs-12 bottom text-center'>"+
                              "<div class='col-xs-12 col-sm-6 emphasis'></div>"+
                              "<div class='col-xs-12 col-sm-12 emphasis'><strong>"+ departamento +"</strong></div>"+
                            "</div>"+
                          "</div>"+
                        "</div>";
                  
                }

                string += '<span class="carga"></span>';       

                $( "span.carga" ).replaceWith( string );                         

              });                                      
            }
                      
            function busqueda(){
            var letra = $("#buscar").val();
            
            $("#buscar").val("");

            @php 
              $cargos = App\Position::get(['id', 'name']);
              $car = [];
              $car2 = [];
              
              foreach ($cargos as $cargo) {
                $car2 = [
                  'id'    => $cargo->id,
                  'name'  => $cargo->name
                ];
                
                array_push($car, $car2);
              }

              $departamentos = App\Department::get(['id', 'name']);
              $dep = [];
              $dep2 = [];
              
              foreach ($departamentos as $departamento) {
                $dep2 = [
                  'id'    => $departamento->id,
                  'name'  => $departamento->name
                ];
                
                array_push($dep, $dep2);
              } 
            @endphp

            var cargos = 
              @php 
                echo json_encode($car); 
              @endphp
            ;

            var departamentos = 
              @php 
                echo json_encode($dep); 
              @endphp
            ;                                  

            $(".contacto").remove();                                    
                                                            
            var datos = {'cadena' : letra, '_token' : $('input[name=_token]').val()};

            var image_url = '';

            var direccion_base =  '{{ URL::asset('images') }}';            
            
            var string = "";
            
            $.post('buscarContacto', datos, function(data){                    
                var cargo = "";
                var departamento = "";
                var corporativo = "";
                var extension = "";

                for(var i = 0; i < data.length; i++){ 
                  if(data[i].telefono_corporativo === null)
                    corporativo = "No posee";
                  else
                    corporativo = data[i].telefono_corporativo;

                  if(data[i].extension === null)
                    extension = "No posee";
                  else
                    extension = data[i].extension;

                  for(var j = 0; j < cargos.length; j++){

                    if(data[i].cargo_id == cargos[j].id){
                      cargo = cargos[j].name;
                    }

                  }

                  for(var j = 0; j < departamentos.length; j++){

                    if(data[i].departamento_id == departamentos[j].id){
                      departamento = departamentos[j].name;                      
                    }

                  }

                  image_url = direccion_base + "/" + data[i].imagen;
                  
                  string += "<div class='col-md-4 col-sm-4 col-xs-12 profile_details contacto'>"+
                          "<div class='well profile_view'>"+
                            "<div class='col-sm-12'>"+
                              "<h4 class='brief'><i><strong>"+ cargo +"</strong></i></h4>"+
                              "<div class='left col-xs-7'>"+
                                "<h2>"+ data[i].primer_nombre + " " + data[i].primer_apellido  +"</h2>"+
                                "<p><i style='color: rgb(51, 204, 204)' class='fa fa-phone'></i><strong style='color: rgb(51, 204, 204)'> Teléfono: </strong> <br>"+ data[i].telefono_movil +" </p>"+
                                "<ul class='list-unstyled'>"+
                                  "<li><i style='color: rgb(51, 204, 204)' class='fa fa-phone'></i> <strong style='color: rgb(51, 204, 204)'>Teléfono corporativo: </strong>"+ corporativo +"</li>"+
                                  "<li><i style='color: rgb(51, 204, 204)' class='fa fa-phone'></i> <strong style='color: rgb(51, 204, 204)'>Extensión: </strong>"+ extension +"</li>"+
                                  "<li><i style='color: rgb(51, 204, 204)' class='fa fa-envelope'></i> <strong style='color: rgb(51, 204, 204)'>Correo: </strong>"+ data[i].email +"</li>"+
                                "</ul>"+
                              "</div>"+
                              "<div class='right col-xs-5 text-center'>"+                                
                                    "<img src='"+ image_url +"' class='img-circle img-responsive'>"+
                              "</div>"+
                            "</div>"+
                            "<div class='col-xs-12 bottom text-center'>"+
                              "<div class='col-xs-12 col-sm-6 emphasis'></div>"+
                              "<div class='col-xs-12 col-sm-12 emphasis'><strong>"+ departamento +"</strong></div>"+
                            "</div>"+
                          "</div>"+
                        "</div>";
                  
                }

                string += '<span class="carga"></span>';       

                $( "span.carga" ).replaceWith( string );                         

              });                                      
            }

            function buscarEnter(e){
                var key = e.keyCode || e.which;
                if(key == 13){
                  busqueda();
                }
            }
        </script>

@endsection