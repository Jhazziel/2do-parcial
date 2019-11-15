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

    
}
