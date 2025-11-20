<?php

namespace App\Http\Controllers\productos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    // Listar productos con el nombre del proveedor
    public function index()
    {
        $productos = DB::table('productos')
            ->join('proveedores', 'productos.id_proveedores', '=', 'proveedores.id')
            ->select('productos.*', 'proveedores.nombre as proveedor_nombre')
            ->get();

        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        $proveedores = DB::table('proveedores')->select('id', 'nombre')->get();
        return view('productos.create', compact('proveedores'));
    }

    // Guardar producto nuevo
    public function store(Request $request)
    {
        DB::table('productos')->insert([
            'nombre' => $request->nombre,
            'costo' => $request->costo,
            'valor_venta' => $request->valor_venta,
            'id_proveedores' => $request->id_proveedores,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto agregado correctamente');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $producto = DB::table('productos')->where('id', $id)->first();
        $proveedores = DB::table('proveedores')->select('id', 'nombre')->get();
        return view('productos.edit', compact('producto', 'proveedores'));
    }

    // Actualizar producto
    public function update(Request $request, $id)
    {
        DB::table('productos')->where('id', $id)->update([
            'nombre' => $request->nombre,
            'costo' => $request->costo,
            'valor_venta' => $request->valor_venta,
            'id_proveedores' => $request->id_proveedores,
            'updated_at' => now(),
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    // Eliminar producto
    public function destroy($id)
    {
        DB::table('productos')->where('id', $id)->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }
}
