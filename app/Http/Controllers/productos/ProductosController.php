<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $productos = DB::table('productos')
            ->join('proveedores', 'productos.id_proveedores', '=', 'proveedores.id')
            ->select('productos.id', 'productos.nombre', 'productos.costo', 'productos.valor_venta', 'proveedores.nombre as proveedor')
            ->get();

        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario para agregar producto
    public function create()
    {
        $proveedores = DB::table('proveedores')->get();
        return view('productos.create', compact('proveedores'));
    }

    // Guardar nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'costo' => 'required|numeric',
            'valor_venta' => 'required|numeric',
            'id_proveedores' => 'required|exists:proveedores,id'
        ]);

        DB::table('productos')->insert([
            'nombre' => $request->nombre,
            'costo' => $request->costo,
            'valor_venta' => $request->valor_venta,
            'id_proveedores' => $request->id_proveedores,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto agregado correctamente');
    }

    // Mostrar formulario para editar producto
    public function edit($id)
    {
        $producto = DB::table('productos')->where('id', $id)->first();
        $proveedores = DB::table('proveedores')->get();
        return view('productos.edit', compact('producto', 'proveedores'));
    }

    // Actualizar producto
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'costo' => 'required|numeric',
            'valor_venta' => 'required|numeric',
            'id_proveedores' => 'required|exists:proveedores,id'
        ]);

        DB::table('productos')->where('id', $id)->update([
            'nombre' => $request->nombre,
            'costo' => $request->costo,
            'valor_venta' => $request->valor_venta,
            'id_proveedores' => $request->id_proveedores,
            'updated_at' => now()
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    // Eliminar producto
    public function destroy($id)
    {
        DB::table('productos')->where('id', $id)->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }

    public function metricas()
{
    // Total de productos
    $totalProductos = DB::table('productos')->count();
    $productos = DB::table('productos')->get();

    // Si no hay productos, evitar división por cero
    if ($totalProductos == 0) {

        $metricas = collect();
        $labels = collect();
        $cantidades = collect();

    } else {

        // Obtener proveedores y contar productos por cada uno
        $metricas = DB::table('proveedores')
            ->leftJoin('productos', 'productos.id_proveedores', '=', 'proveedores.id')
            ->select(
                'proveedores.id',
                'proveedores.nombre',
                DB::raw('COUNT(productos.id) as cantidad_productos')
            )
            ->groupBy('proveedores.id', 'proveedores.nombre')
            ->get()
            ->map(function ($item) use ($totalProductos) {
                $item->porcentaje = round(($item->cantidad_productos / $totalProductos) * 100, 2);
                return $item;
            });

        // Datos para el gráfico
        $labels = $metricas->pluck('nombre');
        $cantidades = $metricas->pluck('cantidad_productos');
    }

    return view('productos.metricas', compact('metricas', 'totalProductos', 'labels', 'cantidades'));
}



}