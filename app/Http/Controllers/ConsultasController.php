<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Clientes;
use App\Direcciones;
use App\Pedidos;
use App\Articulos;
use App\Existencias;
use App\ArticulosPedido;
use App\Fabricas;

class ConsultasController extends Controller
{
    public function consulta1 (Request $request) {
        return Clientes::join('direcciones', 'direcciones.idCliente', '=', 'clientes.id')
                        ->join('pedidos', 'pedidos.idDireccion', '=', 'direcciones.id')
                        ->selectRaw('count(*) as Num_pedidos')
                        ->where('clientes.nombre', 'like', $request->nombre.'%')
                        ->get();
    }

    public function consulta2 () {
        return Pedidos::join('articulos_pedidos', 'pedidos.id', '=', 'articulos_pedidos.idPedido')
                        ->join('articulos', 'articulos.id', '=', 'articulos_pedidos.idArticulo')
                        ->OrderBy('pedidos.fecha', 'asc')
                        ->get();
    }

    public function consulta3 (Request $request) {
        return Clientes::join('direcciones', 'direcciones.idCliente', '=', 'clientes.id')
                        ->join('pedidos', 'pedidos.idDireccion', '=', 'direcciones.id')
                        ->join('articulos_pedidos', 'pedidos.id', '=', 'articulos_pedidos.idPedido')
                        ->join('articulos', 'articulos.id', '=', 'articulos_pedidos.idArticulo')
                        ->select('fecha', 'descripcion as articulo')
                        ->OrderBy('pedidos.fecha', 'asc')
                        ->where('clientes.nombre', 'like', $request->nombre.'%')
                        ->get();
    }

    public function consulta4 () {
        return Pedidos::whereRaw('month(`fecha`) >= 1 AND month(`fecha`) <= 3')
                        ->OrderBy('pedidos.fecha', 'asc')
                        ->get();
    }

    public function consulta5 (Request $request) {
        return Articulos::join('existencias', 'existencias.idArticulo', '=', 'articulos.id')
                        ->join('fabricas', 'fabricas.id', '=', 'existencias.idFabrica')
                        ->select('fabricas.id as num_fabrica', 'articulos.id as num_articulo', 'articulos.descripcion')
                        ->where('fabricas.id', '=', $request->id)
                        ->get();
    }

    public function consulta6 () {
        return ArticulosPedido::join('articulos', 'articulos.id', '=', 'articulos_pedidos.idArticulo')
                        ->selectRaw('`descripcion`, AVG(`cantidad`) as `Promedio de pedidos`')
                        ->GroupBy('articulos.descripcion')
                        ->get();
    }

    public function consulta7 (Request $request) {
        return Direcciones::join('pedidos', 'pedidos.idDireccion', '=', 'direcciones.id')
                        ->select('pedidos.id as `Numero de pedido`', 'fecha')
                        ->where('direcciones.ciudad', '=', $request->ciudad)
                        ->get();
    }

    public function consulta8 (Request $request) {
        return Articulos::join('existencias', 'existencias.idArticulo', '=', 'articulos.id')
                        ->join('fabricas', 'fabricas.id', '=', 'existencias.idFabrica')
                        ->select('fabricas.id as num_fabrica', 'articulos.id as num_articulo', 'articulos.descripcion', 'existencias.cantidad')
                        ->where('fabricas.id', '=', $request->id)
                        ->where('existencias.cantidad', '>', 0)
                        ->get();
    }

    public function consulta9 () {
        return Clientes::join('direcciones', 'direcciones.idCliente', '=', 'clientes.id')
                        ->select('nombre')
                        ->whereRaw('`direcciones`.`id` not in(select `pedidos`.`idDireccion` from `direcciones` join `pedidos` on `pedidos`.`idDireccion` = `direcciones`.`id`)')
                        ->get();
    }

    public function consulta10 () {

        //tengo problemas al generar esta consulta con eloquent
        //el enunciado es el siguiente: 
        // - Mostrar la ciudad con más clientes
        //
        //la consulta es compleja, con puro comando seria de la siguiente manera:
        //
        // - select ciudad, MAX(contador) 'cantidad clientes' from (select ciudad, count(*) as contador from direcciones group by ciudad) as tabla1
        //
        //el problema reside en el hecho de que no tengo idea de como hacer un select a una tabla creada en la misma consulta
        //por ejemplo para una consulta select simple con eloquent, como:
        //
        //$tabla = Direcciones::all();
        //
        //eloquent obtiene el argumento para FROM de Direcciones, pero lo que necesito hacer es crear una tabla dentro de la misma consulta,
        //mediante un select, y esa tabla recien generada utilizala como argumento para el FROM, cosa que no supe como hacer :(
    }

    public function consulta11 () {
        return Clientes::max('descuento');
    }

    public function consulta12 () {
        return Pedidos::count();
    }
}
