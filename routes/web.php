<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('api/users', ['as'=>'api.users','uses'=>'apiController@getUsers']);

Route::get('api/empleados', 'apiController@getUsers2');

Route::get('api/colaboradores/{id}', ['as'=>'api.colaboradores','uses'=>'apiController@getColaboradores']);

Route::post('buscarContactos', 'apiController@contactos');

Route::post('buscarContacto', 'apiController@buscarContacto');

Route::post('categoriasDepartamento', 'apiController@buscarCategorias');

Route::get('/home', 'HomeController@index');

Route::post('/usuarios', 'UserController@store');

Route::post('actualizarEncargado', 'EncargadoController@change');

Route::resource('usuarios', 'UserController');

Route::resource('parametros/unidades', 'DepartmentController');

Route::resource('parametros/cargos', 'PositionController');

Route::resource('parametros/paises', 'CountryController');

Route::resource('parametros/estados', 'StateController');

Route::resource('parametros/ciudades', 'CityController');

Route::resource('parametros/profesiones', 'OccupationController');

Route::resource('parametros/encargado', 'EncargadoController');

Route::resource('solicitudes/crearTicket', 'TicketController');

Route::resource('solicitudes/listarTickets', 'TicketListController');

Route::get('solicitudes/listarTicketsCreados', 'TicketListController@creados');

Route::get('solicitudes/TicketsCerrados', 'TicketListController@cerrados');

Route::get('solicitudes/TicketsCerradosUsuario', 'TicketListController@cerradosUsuario');

Route::resource('solicitudes/categorias', 'CategoriesController');

Route::post('solicitudes/nuevo_ticket', 'TicketController@store');

Route::get('solicitudes/ticket/{ticket_id}', 'TicketController@show');

Route::post('comentar', 'CommentsController@postComment');

Route::post('cerrarTicket', 'TicketController@close');

Route::post('delegarTicket', 'TicketController@delegar');

Route::post('escalarTicket', 'TicketController@escalar');

Route::post('ticketAtendido', 'TicketController@atender');

Route::post('reabrirTicket', 'TicketController@reabrir');

Route::post('descargarAdjunto', 'TicketController@descargar');

Route::get('perfil', 'UserController@change');

Route::post('changePassword', 'UserController@updatePassword');

Route::get('evaluaciones/instrumentos/dimensiones/{departamento}/{cargo}', 'InstrumentosController@dimensiones')->name('ver_dimensiones');

Route::resource('evaluaciones/instrumentos', 'InstrumentosController');

Route::resource('evaluaciones/bono', 'BonosController');

Route::resource('evaluaciones/dimension', 'DimensionesController', ['except' => ['create']]);

Route::resource('evaluaciones/prima', 'PrimasController');

Route::resource('evaluaciones/evaluacion', 'EvaluarController');

Route::get('evaluaciones/dimensiones/{id}', 'DimensionesController@index')->name('listar_dimensiones');

Route::get('evaluaciones/dimension/create/{id}', ['as' => 'dimension.create', 'uses' => 'DimensionesController@create']); 

Route::resource('evaluaciones/indicadores', 'IndicadoresController');

Route::resource('evaluaciones/target', 'TargetController', ['except' => ['show']]);

Route::get('evaluaciones/target/minimo', 'TargetController@show')->name('target.minimo');

Route::post('evaluaciones/target/minimo', 'TargetController@storeMinimo')->name('saveMinimo');

Route::resource('contactos', 'ContactosController');