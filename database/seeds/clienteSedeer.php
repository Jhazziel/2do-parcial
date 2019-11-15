<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class clienteSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i=0; $i < 10; $i++) { 
            DB::table('clientes')->insert([
                'nombre' => Str::random(5),
                'saldo' => 100/rand(1,100),
                'limiteCredito' => 100/rand(1,100),
                'descuento' => rand(1, 100),
                'activo' => 1,
            ]);
        }

        for ($i=0; $i < 3; $i++) { 
            DB::table('fabricas')->insert([
                'telefono' => rand(12345678, 70000000),
            ]);
        }

        for ($i=0; $i < 10; $i++) { 
            DB::table('articulos')->insert([
                'descripcion' => Str::random(10),
            ]);
        }

        for ($i=0; $i < 10; $i++) { 
            DB::table('existencias')->insert([
                'idArticulo' => rand(1, 10),
                'idFabrica' => rand(1, 3),
                'cantidad' => rand(0, 1000) ? $i != 0 && $i%2 != 0 : 0,
            ]);
        }

        for ($i=0; $i < 10; $i++) { 
            DB::table('direcciones')->insert([
                'calle' => Str::random(15),
                'comuna' => Str::random(20),
                'ciudad' => Str::random(10),
                'idCliente' => $i+1,
            ]);
        }

        for ($i=0; $i < 10; $i++) { 
            DB::table('pedidos')->insert([
                'fecha' => '2019'.'/'.rand(1, 12).'/'.rand(1, 28),
                'idDireccion' => rand(1, 10),
            ]);
        }

        for ($i=0; $i < 50; $i++) { 
            DB::table('articulos_pedidos')->insert([
                'idArticulo' => rand(1, 10),
                'idPedido' => rand(1, 10),
                'cantidad' => rand(1, 30),
            ]);
        }
    }
}
