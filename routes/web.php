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

Route::get('/home', 'HomeController@index');

Route::post('/usuarios', 'UserControler@store');

Route::resource('usuarios', 'UserController');

Route::resource('parametros/departamentos', 'DepartmentController');

Route::resource('parametros/cargos', 'PositionController');

Route::resource('parametros/paises', 'CountryController');

Route::resource('parametros/estados', 'StateController');

Route::resource('parametros/ciudades', 'CityController');

Route::resource('solicitudes/crearTicket', 'TicketController');

Route::resource('solicitudes/listarTickets', 'TicketListController');