<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Insumo;
use App\Models\Producto;
use App\Models\ProductoInsumo;
use DB;
use Illuminate\Http\Request;

class ProductoInsumoController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        $insumos = Insumo::all();

        return view("productoinsumo.index", compact("categorias", "insumos"));
    }

    public function save(Request $request)
    {

        $input = $request->all();
        try {
            DB::beginTransaction();
            $producto = Producto::create([
                "nombre" => $input["nombre"],
                "cantidad" => $input["cantidad"],
                "categoria_id" => $input["categoria_id"],
                "precio" => $this->calcular_precio($input["insumo_id"], $input["cantidades"]),
            ]);

            foreach($input["insumo_id"] as $key => $value){
                ProductoInsumo::create([
                    "insumo_id"=>$value,
                    "producto_id"=>$producto->id,
                    "cantidad" => $input["cantidades"][$key]
                ]);

                $ins = Insumo::find($value);
                $ins->update(["cantidad"=> $ins->cantidad - $input["cantidades"][$key]]);
            }
            
            DB::commit();
            return redirect("/producto/listar")->with('status', '1');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect("/producto/listar")->with('status', $e->getMessage());
        }
    }

    public function calcular_precio($insumos, $cantidades)
    {
        $precio = 0;
        foreach ($insumos as $key => $value) {
            $insumo = Insumo::find($value);
            $precio += ($insumo->precio * $cantidades[$key]);
        }
        return $precio;
    }

    public function show(Request $request){

        $id = $request->input("id");
        $insumos = [];
        if($id != null){
            $insumos = Insumo::select("insumo.*", "producto_insumo.cantidad as cantidad_c")
            ->join("producto_insumo", "insumo.id", "=", "producto_insumo.insumo_id")
            ->where("producto_insumo.producto_id", $id)
            ->get();
        }

        $productos = Producto::select("producto.*", "categoria.nombre as categoria")
        ->join("categoria", "categoria.id", "=", "producto.categoria_id")
        ->get();

        return view("productoinsumo.show", compact("productos", "insumos"));
    }
}
