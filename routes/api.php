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
Route::post('consulta/2', 'ConsultasController@consulta2');
