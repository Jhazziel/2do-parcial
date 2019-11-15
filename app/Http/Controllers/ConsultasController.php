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

    public function consulta1 (Request $request) {
        return Clientes::join('direcciones', 'direcciones.idCliente', '=', 'clientes.id')
                        ->join('pedidos', 'pedidos.idDireccion', '=', 'direcciones.id')
                        ->selectRaw('count(*) as Num_pedidos')
                        ->where('clientes.nombre', 'like', $request->nombre.'%')
                        ->get();
    }
}
