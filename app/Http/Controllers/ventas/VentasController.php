<?php

namespace App\Http\Controllers\ventas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    // -----------------------------------------
    // INDEX
    // -----------------------------------------
    public function index()
{
    $ventas = DB::table('ventas')
        ->leftJoin('clientes', 'clientes.id', '=', 'ventas.id_cliente')
        ->leftJoin('ventas_detalles', 'ventas_detalles.id_venta', '=', 'ventas.id')
        ->leftJoin('productos', 'productos.id', '=', 'ventas_detalles.id_producto')
        ->select(
            'ventas.id',
            'ventas.fecha',
            'ventas.observaciones',
            DB::raw('clientes.nombre AS cliente_nombre'),
            DB::raw('clientes.apellido AS cliente_apellido'),
            // Productos concatenados con cantidad: "Producto A (2), Producto B (1)"
            DB::raw("GROUP_CONCAT(CONCAT(productos.nombre, ' (', IFNULL(ventas_detalles.cantidad,0), ')') ORDER BY productos.nombre SEPARATOR ', ') AS productos_listado"),
            // Total calculado: suma(cantidad * precio_unitario)
            DB::raw('IFNULL(SUM(ventas_detalles.cantidad * ventas_detalles.precio_unitario), 0) AS total')
        )
        ->groupBy(
            'ventas.id',
            'ventas.fecha',
            'ventas.observaciones',
            'clientes.nombre',
            'clientes.apellido'
        )
        ->orderBy('ventas.id', 'desc')
        ->get();

    return view('ventas.index', compact('ventas'));
}



    // -----------------------------------------
    // CREATE
    // -----------------------------------------
    public function create()
    {
        // Clientes y productos para los selects del formulario.
        // Productos trae el precio por defecto (valor_venta) para usar como precio inicial.
        $clientes = DB::table('clientes')->orderBy('nombre')->get();

        $productos = DB::table('productos')
            ->select('id', 'nombre', 'valor_venta as precio')
            ->orderBy('nombre')
            ->get();

        return view('ventas.create', compact('clientes', 'productos'));
    }

    // -----------------------------------------
    // STORE
    // -----------------------------------------
    public function store(Request $request)
{
    $request->validate([
        'id_cliente' => 'required|integer|exists:clientes,id',
        'fecha' => 'required|date',
        'observaciones' => 'nullable|string',

        'id_producto' => 'required|array',
        'id_producto.*' => 'required|integer|exists:productos,id',

        'cantidad' => 'required|array',
        'cantidad.*' => 'required|integer|min:1',

        'precio' => 'required|array',
        'precio.*' => 'required|numeric|min:0',
    ]);

    // Insertar venta
    $ventaId = DB::table('ventas')->insertGetId([
        'id_cliente' => $request->id_cliente,
        'fecha' => $request->fecha,
        'observaciones' => $request->observaciones,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Insertar detalles
    foreach ($request->id_producto as $i => $prodId) {
        if (empty($prodId)) continue;

        DB::table('ventas_detalles')->insert([
            'id_venta' => $ventaId,
            'id_producto' => $prodId,
            'cantidad' => $request->cantidad[$i] ?? 1,
            'precio_unitario' => $request->precio[$i] ?? 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
}

    // -----------------------------------------
    // SHOW
    // -----------------------------------------
    public function show($id)
    {
        $venta = DB::table('ventas')
            ->leftJoin('clientes', 'clientes.id', '=', 'ventas.id_cliente')
            ->select(
                'ventas.*',
                DB::raw("clientes.nombre AS cliente")
            )
            ->where('ventas.id', $id)
            ->first();

        $detalles = DB::table('ventas_detalles')
            ->leftJoin('productos', 'productos.id', '=', 'ventas_detalles.id_producto')
            ->select(
                'ventas_detalles.id as detalle_id',
                'ventas_detalles.id_producto',
                'ventas_detalles.cantidad',
                'ventas_detalles.precio_unitario',
                DB::raw('(ventas_detalles.precio_unitario * ventas_detalles.cantidad) as subtotal'),
                'productos.nombre as producto'
            )
            ->where('ventas_detalles.id_venta', $id)
            ->get();

        return view('ventas.show', compact('venta', 'detalles'));
    }

    // -----------------------------------------
    // EDIT
    // -----------------------------------------
    public function edit($id)
    {
        $venta = DB::table('ventas')->where('id', $id)->first();

        $clientes = DB::table('clientes')->orderBy('nombre')->get();
        $productos = DB::table('productos')->select('id', 'nombre', 'valor_venta as precio')->orderBy('nombre')->get();

        $detalles = DB::table('ventas_detalles')
            ->leftJoin('productos', 'productos.id', '=', 'ventas_detalles.id_producto')
            ->select(
                'ventas_detalles.*',
                'productos.nombre as producto'
            )
            ->where('ventas_detalles.id_venta', $id)
            ->get();

        return view('ventas.edit', compact('venta', 'clientes', 'productos', 'detalles'));
    }

    // -----------------------------------------
    // UPDATE
    // -----------------------------------------
   public function update(Request $request, $id)
{
    // Validación
    $request->validate([
        'id_cliente' => 'required|integer|exists:clientes,id',
        'fecha' => 'required|date',
        'observaciones' => 'nullable|string',

        'productos' => 'required|array|min:1',
        'productos.*.id' => 'required|integer|exists:productos,id',
        'productos.*.cantidad' => 'required|integer|min:1',
        'productos.*.precio' => 'required|numeric|min:0',
    ]);

    // Buscar la venta
    $venta = DB::table('ventas')->where('id', $id)->first();
    if (!$venta) {
        return redirect()->route('ventas.index')->with('error', 'Venta no encontrada.');
    }

    // Actualizar cabecera
    DB::table('ventas')->where('id', $id)->update([
        'id_cliente' => $request->id_cliente,
        'fecha' => $request->fecha,
        'observaciones' => $request->observaciones,
        'updated_at' => now(),
    ]);

    // Eliminar detalles antiguos
    DB::table('ventas_detalles')->where('id_venta', $id)->delete();

    // Preparar e insertar nuevos detalles
    $detalles = [];
    foreach ($request->productos as $prod) {
        $detalles[] = [
            'id_venta' => $id,
            'id_producto' => $prod['id'],
            'cantidad' => $prod['cantidad'],
            'precio_unitario' => $prod['precio'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    if (!empty($detalles)) {
        DB::table('ventas_detalles')->insert($detalles);
    }

    // Redireccionar a index sin tocar total
    return redirect()->route('ventas.index')->with('success', 'Venta actualizada correctamente.');
}


    // -----------------------------------------
    // DESTROY
    // -----------------------------------------
    public function destroy($id)
    {
        DB::table('ventas_detalles')->where('id_venta', $id)->delete();
        DB::table('ventas')->where('id', $id)->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente.');
    }
}
