<?php

namespace App\Http\Controllers\compras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComprasController extends Controller
{
    // -----------------------------------------
    // INDEX
    // -----------------------------------------
    public function index()
    {
        $compras = DB::select("
            SELECT c.id, c.fecha, c.observaciones,
                   p.nombre AS proveedor
            FROM compras c
            LEFT JOIN proveedores p ON p.id = c.id_proveedor
            ORDER BY c.id DESC
        ");

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
        // Insertar CABECERA
        $id_compra = DB::table('compras')->insertGetId([
            'id_proveedor'  => $request->id_proveedor,
            'fecha'         => $request->fecha,
            'observaciones' => $request->observaciones,
            'created_at'    => now(),
            'updated_at'    => now()
        ]);

        // Productos puede venir null → se controla
        $productos = $request->productos ?? [];

        if (!empty($productos)) {
            foreach ($productos as $p) {

                // Validación interna por seguridad
                if (!isset($p['id']) || !isset($p['cantidad']) || !isset($p['precio'])) {
                    continue;
                }

                DB::table('compras_detalle')->insert([
                    'id_compra'       => $id_compra,
                    'id_producto'     => $p['id'],
                    'cantidad'        => $p['cantidad'],
                    'precio_unitario' => $p['precio'],
                    'created_at'      => now(),
                    'updated_at'      => now()
                ]);
            }
        }

        return redirect()->route('compras.index');
    }

    // -----------------------------------------
    // SHOW
    // -----------------------------------------
    public function show($id)
{
    // Datos de la compra
    $compra = DB::selectOne("
        SELECT c.*, p.nombre AS proveedor
        FROM compras c
        LEFT JOIN proveedores p ON p.id = c.id_proveedor
        WHERE c.id = ?
    ", [$id]);

    // Detalles de la compra
    $detalles = DB::select("
        SELECT d.*, pr.nombre AS producto, pr.valor_venta
        FROM compras_detalle d
        LEFT JOIN productos pr ON pr.id = d.id_producto
        WHERE d.id_compra = ?
    ", [$id]);

    // NECESARIO PARA EL SELECT DEL SHOW
    $proveedores = DB::table('proveedores')->get();

    return view('compras.show', compact('compra', 'detalles', 'proveedores'));
}


    // -----------------------------------------
    // EDIT
    // -----------------------------------------
    public function edit($id)
    {
        $compra = DB::selectOne("
            SELECT c.*, p.nombre AS proveedor
            FROM compras c
            LEFT JOIN proveedores p ON p.id = c.id_proveedor
            WHERE c.id = ?
        ", [$id]);

        $proveedores = DB::table('proveedores')->get();

        $productos = DB::select("
            SELECT id, nombre, valor_venta AS precio
            FROM productos
            ORDER BY nombre
        ");

        return view('compras.edit', compact('compra', 'proveedores', 'productos'));
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

        return redirect()->route('compras.index');
    }

    // -----------------------------------------
    // DESTROY
    // -----------------------------------------
    public function destroy($id)
    {
        DB::table('compras_detalle')->where('id_compra', $id)->delete();
        DB::table('compras')->where('id', $id)->delete();

        return redirect()->route('compras.index');
    }
}
