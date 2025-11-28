<?php

namespace App\Http\Controllers\compras;

use App\Http\Controllers\Controller; // <--- Esto es correcto
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprasController extends Controller
{
    // -----------------------------------------
    // INDEX
    // -----------------------------------------
public function index()
{
    $compras = DB::table('compras')
        ->select(
            'compras.id',
            'compras.fecha',
            'compras.observaciones',
            'proveedores.nombre as proveedor',
            DB::raw('GROUP_CONCAT(productos.nombre ORDER BY productos.nombre SEPARATOR ", ") as productos'),
            DB::raw('SUM(compras_detalle.precio_unitario) as total_precios')
        )
        ->leftJoin('proveedores', 'proveedores.id', '=', 'compras.id_proveedor')
        ->leftJoin('compras_detalle', 'compras_detalle.id_compra', '=', 'compras.id')
        ->leftJoin('productos', 'productos.id', '=', 'compras_detalle.id_producto')
        ->groupBy(
            'compras.id',
            'compras.fecha',
            'compras.observaciones',
            'proveedores.nombre'
        )
        ->orderByDesc('compras.id')
        ->get();

    return view('compras.index', compact('compras'));
}


    // -----------------------------------------
    // CREATE
    // -----------------------------------------
    public function create()
    {
        $proveedores = DB::table('proveedores')->get();

        // Se usa valor_venta como precio
        $productos = DB::select("
            SELECT id, nombre, valor_venta AS precio
            FROM productos
            ORDER BY nombre
        ");

        return view('compras.create', compact('proveedores', 'productos'));
    }

    // -----------------------------------------
    // STORE
    // -----------------------------------------
    public function store(Request $request)
{
    // 1. Validación
    $request->validate([
        'id_proveedor' => 'required|integer',
        'fecha' => 'required|date',
        'observaciones' => 'nullable|string',

        'id_producto' => 'required|array',
        'id_producto.*' => 'required|integer',

        'cantidad' => 'required|array',
        'cantidad.*' => 'required|integer|min:1',

        'costo' => 'required|array',
        'costo.*' => 'required|numeric|min:0',
    ]);

    // 2. Guardar la compra (tabla compras)
    $compraId = DB::table('compras')->insertGetId([
        'id_proveedor' => $request->id_proveedor,
        'fecha' => $request->fecha,
        'observaciones' => $request->observaciones,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // 3. Guardar los detalles
    $productos = $request->id_producto;
    $cantidades = $request->cantidad;
    $costos = $request->costo;

    $detalles = [];

    foreach ($productos as $i => $prodId) {

        // Saltear productos vacíos (por si el usuario deja uno en blanco)
        if (!$prodId) continue;

        $detalles[] = [
            'id_compra' => $compraId,
            'id_producto' => $prodId,
            'cantidad' => $cantidades[$i],
            'precio_unitario' => $costos[$i],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    // Insert masivo
    DB::table('compras_detalle')->insert($detalles);

    return redirect()->route('compras.index')->with('success', 'Compra agregada correctamente');
}


    // -----------------------------------------
    // SHOW
    // -----------------------------------------
      public function show($id)
{
    // Datos de la compra
    $compra = DB::table('compras')
        ->leftJoin('proveedores', 'proveedores.id', '=', 'compras.id_proveedor')
        ->where('compras.id', $id)
        ->select(
            'compras.id', // Para que las rutas y botones funcionen
            'compras.id as compra_id', // Para mostrar en la factura
            'compras.id_proveedor',
            'compras.observaciones',
            'compras.fecha',
            'proveedores.nombre as proveedor'
        )
        ->first();

    // Detalles de la compra
    $detalles = DB::table('compras_detalle')
        ->leftJoin('productos', 'productos.id', '=', 'compras_detalle.id_producto')
        ->where('compras_detalle.id_compra', $id)
        ->select(
            'compras_detalle.id as detalle_id',
            'compras_detalle.id_compra',
            'compras_detalle.id_producto',
            'compras_detalle.cantidad',
            'compras_detalle.precio_unitario',
            'productos.nombre as producto',
            'productos.valor_venta'
        )
        ->get();

    // Para los selects (si los necesitaras en la vista)
    $proveedores = DB::table('proveedores')->get();
    $productos = DB::table('productos')->get();

    return view('compras.show', compact(
        'compra',
        'detalles',
        'proveedores',
        'productos'
    ));
}





    // -----------------------------------------
    // EDIT
    // -----------------------------------------
    public function edit($id)
{
    // Datos de la compra
    $compra = DB::table('compras')
    ->leftJoin('proveedores', 'proveedores.id', '=', 'compras.id_proveedor')
    ->select('compras.*', 'compras.id as compra_id', 'proveedores.nombre AS proveedor')
    ->where('compras.id', $id)
    ->first();


    // Detalles de la compra
    $detalles = DB::table('compras_detalle')
        ->leftJoin('productos', 'productos.id', '=', 'compras_detalle.id_producto')
        ->select(
            'compras_detalle.*',
            'productos.nombre AS producto',
            'productos.valor_venta'
        )
        ->where('compras_detalle.id_compra', $id)
        ->get();

    // Para los selects del formulario
    $proveedores = DB::table('proveedores')->get();
    $productos   = DB::table('productos')->get();

    return view('compras.edit', compact('compra', 'detalles', 'productos', 'proveedores'));
}


    // -----------------------------------------
    // UPDATE
    // -----------------------------------------
    public function update(Request $request, $id)
    {
        // Actualizamos cabecera
        DB::table('compras')->where('id', $id)->update([
            'id_proveedor'  => $request->id_proveedor,
            'fecha'         => $request->fecha,
            'observaciones' => $request->observaciones,
            'updated_at'    => now()
        ]);

        // Borramos detalles anteriores
        DB::table('compras_detalle')->where('id_compra', $id)->delete();

        // Productos puede venir null
        $productos = $request->productos ?? [];

        if (!empty($productos)) {
            foreach ($productos as $p) {

                if (!isset($p['id']) || !isset($p['cantidad']) || !isset($p['precio'])) {
                    continue;
                }

                DB::table('compras_detalle')->insert([
                    'id_compra'       => $id,
                    'id_producto'     => $p['id'],
                    'cantidad'        => $p['cantidad'],
                    'precio_unitario' => $p['precio'],
                    'created_at'      => now(),
                    'updated_at'      => now()
                ]);
            }
        }

        return redirect()->route('compras.index')->with('success', 'Compra editada correctamente');
    }

    // -----------------------------------------
    // DESTROY
    // -----------------------------------------
    public function destroy($id)
    {
        DB::table('compras_detalle')->where('id_compra', $id)->delete();
        DB::table('compras')->where('id', $id)->delete();

        return redirect()->route('compras.index')->with('success', 'Compra eliminada correctamente');
    }



   public function metricas()
{
    // Total de compras realizadas
    $totalCompras = DB::table('compras')->count();

    // Obtener proveedores y contar cuántas compras se les hizo
    $metricas = DB::table('proveedores')
        ->leftJoin('compras', 'compras.id_proveedor', '=', 'proveedores.id')
        ->select(
            'proveedores.id',
            'proveedores.nombre',
            DB::raw('COUNT(compras.id) as cantidad_compras')
        )
        ->groupBy('proveedores.id', 'proveedores.nombre')
        ->get()
        ->map(function ($item) use ($totalCompras) {
            $item->porcentaje = $totalCompras > 0 
                ? round(($item->cantidad_compras / $totalCompras) * 100, 2)
                : 0;
            return $item;
        });

    // Si no hay compras, aseguramos al menos una fila vacía
    if ($metricas->isEmpty()) {
        $metricas = collect([
            (object)[
                'id' => null,
                'nombre' => '',
                'cantidad_compras' => 0,
                'porcentaje' => 0
            ]
        ]);
    }

    // Datos para gráfico
    $labels = $metricas->pluck('nombre');
    $cantidades = $metricas->pluck('cantidad_compras');

    return view('compras.metricas', compact('metricas', 'totalCompras', 'labels', 'cantidades'));


}

// Nueva función para filtrar por rango de fechas
public function metricasPorRango(Request $request)
{
    $request->validate([
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
    ]);

    $fechaInicio = $request->fecha_inicio;
    $fechaFin = $request->fecha_fin;

    // Total de compras en el rango
    $totalCompras = DB::table('compras')
        ->whereBetween('created_at', [$fechaInicio, $fechaFin])
        ->count();

    if ($totalCompras == 0) {
        // Si no hay compras, devolvemos colecciones vacías para no romper la vista
        $metricas = collect();
        $labels = collect();
        $cantidades = collect();
    } else {
        // Obtener métricas por proveedor
        $metricas = DB::table('proveedores')
            ->leftJoin('compras', 'compras.id_proveedor', '=', 'proveedores.id')
            ->leftJoin('compras_detalle', 'compras_detalle.id_compra', '=', 'compras.id')
            ->leftJoin('productos', 'productos.id', '=', 'compras_detalle.id_producto') // para obtener el costo
            ->whereBetween('compras.created_at', [$fechaInicio, $fechaFin])
            ->select(
                'proveedores.id',
                'proveedores.nombre',
                DB::raw('COUNT(DISTINCT compras.id) as cantidad_compras'),
                DB::raw('SUM(productos.costo * compras_detalle.cantidad) as costo_total')
            )
            ->groupBy('proveedores.id', 'proveedores.nombre')
            ->get()
            ->map(function ($item) use ($totalCompras) {
                $item->porcentaje = $totalCompras > 0 ? round(($item->cantidad_compras / $totalCompras) * 100, 2) : 0;
                $item->costo_total = $item->costo_total ?? 0;
                return $item;
            });

        // Datos para el gráfico
        $labels = $metricas->pluck('nombre');
        $cantidades = $metricas->pluck('cantidad_compras');
    }

    return view(
        'compras.rango',
        compact('metricas', 'labels', 'cantidades', 'fechaInicio', 'fechaFin')
    );
}

}