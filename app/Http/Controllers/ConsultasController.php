<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return Direcciones::max('count(*)');
    }

    public function consulta11 () {
        return Clientes::max('descuento');
    }

    public function consulta12 () {
        return Pedidos::count();
    }
}
