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

Route::get('/home', 'HomeController@index');

Route::post('/usuarios', 'UserControler@store');

Route::resource('usuarios', 'UserController');

Route::resource('parametros/unidades', 'DepartmentController');

Route::resource('parametros/cargos', 'PositionController');

Route::resource('parametros/paises', 'CountryController');

Route::resource('parametros/estados', 'StateController');

Route::resource('parametros/ciudades', 'CityController');

Route::resource('solicitudes/crearTicket', 'TicketController');

Route::resource('solicitudes/listarTickets', 'TicketListController');

Route::resource('solicitudes/categorias', 'CategoriesController');

Route::post('solicitudes/nuevo_ticket', 'TicketController@store');

Route::get('solicitudes/ticket/{ticket_id}', 'TicketController@show');

Route::post('comentar', 'CommentsController@postComment');