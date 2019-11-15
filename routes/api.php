<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// CRUD clientes
Route::get('clientes/listar', 'ClientesController@index');
Route::post('clientes/crear', 'ClientesController@store');
Route::put('clientes/actualizar/{id}', 'ClientesController@update');
Route::put('clientes/eliminar/{id}', 'ClientesController@destroy');

//Consultas
Route::post('consulta/1', 'ConsultasController@consulta1');
Route::get('consulta/2', 'ConsultasController@consulta2');
Route::post('consulta/3', 'ConsultasController@consulta3');
Route::get('consulta/4', 'ConsultasController@consulta4');
Route::post('consulta/5', 'ConsultasController@consulta5');
Route::get('consulta/6', 'ConsultasController@consulta6');
Route::get('consulta/7', 'ConsultasController@consulta7');
Route::get('consulta/8', 'ConsultasController@consulta8');
Route::get('consulta/9', 'ConsultasController@consulta9');
Route::get('consulta/10', 'ConsultasController@consulta10');
Route::get('consulta/11', 'ConsultasController@consulta11');
Route::get('consulta/12', 'ConsultasController@consulta12');
