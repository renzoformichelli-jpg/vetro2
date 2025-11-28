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

public function metricas()
{
    // Total de ventas realizadas
    $totalVentas = DB::table('ventas')->count();

    // Total histórico ganado (suma de todas las ventas)
    $totalGanado = DB::table('ventas_detalles')
        ->join('productos', 'productos.id', '=', 'ventas_detalles.id_producto')
        ->select(DB::raw('SUM(productos.valor_venta * ventas_detalles.cantidad) as total'))
        ->value('total');

    // Si no hay ventas, totalGanado queda en 0
    $totalGanado = $totalGanado ?? 0;

    // Obtener clientes y contar cuántas ventas se les hizo
    $metricas = DB::table('clientes')
        ->leftJoin('ventas', 'ventas.id_cliente', '=', 'clientes.id')
        ->select(
            'clientes.id',
            'clientes.nombre',
            DB::raw('COUNT(ventas.id) as cantidad_ventas')
        )
        ->groupBy('clientes.id', 'clientes.nombre')
        ->get()
        ->map(function ($item) use ($totalVentas) {
            $item->porcentaje = $totalVentas > 0 
                ? round(($item->cantidad_ventas / $totalVentas) * 100, 2)
                : 0;
            return $item;
        });

    if ($metricas->isEmpty()) {
        $metricas = collect([
            (object)[
                'id' => null,
                'nombre' => '',
                'cantidad_ventas' => 0,
                'porcentaje' => 0
            ]
        ]);
    }

    $labels = $metricas->pluck('nombre');
    $cantidades = $metricas->pluck('cantidad_ventas');

    return view('ventas.metricas', compact(
        'metricas',
        'totalVentas',
        'labels',
        'cantidades',
        'totalGanado' // <-- agregado
    ));
}

// Métricas por rango de fechas
public function metricasPorRango(Request $request)
{
    $request->validate([
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    ]);

    $fechaInicio = $request->fecha_inicio;
    $fechaFin = $request->fecha_fin;

    $totalVentas = DB::table('ventas')
        ->whereBetween('created_at', [$fechaInicio, $fechaFin])
        ->count();

    // *** AGREGADO: total ganado en el rango ***
    $totalGanadoRango = DB::table('ventas')
        ->leftJoin('ventas_detalles', 'ventas_detalles.id_venta', '=', 'ventas.id')
        ->leftJoin('productos', 'productos.id', '=', 'ventas_detalles.id_producto')
        ->whereBetween('ventas.created_at', [$fechaInicio, $fechaFin])
        ->select(DB::raw('SUM(productos.valor_venta * ventas_detalles.cantidad) AS total'))
        ->value('total') ?? 0;

    if ($totalVentas == 0) {
        $metricas = collect();
        $labels = collect();
        $cantidades = collect();
    } else {

        $metricas = DB::table('clientes')
            ->leftJoin('ventas', 'ventas.id_cliente', '=', 'clientes.id')
            ->leftJoin('ventas_detalles', 'ventas_detalles.id_venta', '=', 'ventas.id')
            ->leftJoin('productos', 'productos.id', '=', 'ventas_detalles.id_producto')
            ->leftJoin('proveedores', 'proveedores.id', '=', 'productos.id_proveedores')
            ->whereBetween('ventas.created_at', [$fechaInicio, $fechaFin])
            ->select(
                'clientes.id',
                'clientes.nombre',
                DB::raw('COUNT(DISTINCT ventas.id) as cantidad_ventas'),
                DB::raw('SUM(productos.valor_venta * ventas_detalles.cantidad) as valor_total'),
                DB::raw("GROUP_CONCAT(DISTINCT proveedores.nombre ORDER BY proveedores.nombre SEPARATOR ', ') as proveedores")
            )
            ->groupBy('clientes.id', 'clientes.nombre')
            ->get()
            ->map(function ($item) use ($totalVentas) {
                $item->porcentaje = $totalVentas > 0
                    ? round(($item->cantidad_ventas / $totalVentas) * 100, 2)
                    : 0;

                $item->valor_total = $item->valor_total ?? 0;
                $item->proveedores = $item->proveedores ?? '';

                return $item;
            });

        $labels = $metricas->pluck('nombre');
        $cantidades = $metricas->pluck('cantidad_ventas');
    }

    return view(
        'ventas.rango',
        compact('metricas', 'labels', 'cantidades', 'fechaInicio', 'fechaFin', 'totalGanadoRango', 'totalVentas')
    );
}



}
