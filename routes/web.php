<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\proveedores\ProveedoresController;
use App\Http\Controllers\productos\ProductosController;
use App\Http\Controllers\clientes\ClientesController;
use App\Http\Controllers\ventas\VentasController;
use App\Http\Controllers\compras\ComprasController;

// Página principal
Route::get('/', function () {
    return view('index');
});

// ---------------------------
// PROVEEDORES
// ---------------------------
Route::get('/proveedores/metricas', [ProveedoresController::class, 'metricas'])->name('proveedores.metricas');
Route::get('/proveedores', [ProveedoresController::class, 'index'])->name('proveedores.index');
Route::get('/proveedores/create', [ProveedoresController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedoresController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores/{id}/edit', [ProveedoresController::class, 'edit'])->name('proveedores.edit');
Route::put('/proveedores/{id}', [ProveedoresController::class, 'update'])->name('proveedores.update');
Route::delete('/proveedores/{id}', [ProveedoresController::class, 'destroy'])->name('proveedores.destroy');

// ---------------------------
// PRODUCTOS
// ---------------------------
Route::get('/productos/metricas', [ProductosController::class, 'metricas'])->name('productos.metricas');
Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
Route::get('/productos/create', [ProductosController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductosController::class, 'store'])->name('productos.store');
Route::get('/productos/{id}/edit', [ProductosController::class, 'edit'])->name('productos.edit');
Route::put('/productos/{id}', [ProductosController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');

// ---------------------------
// CLIENTES
// ---------------------------
Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{id}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{id}', [ClientesController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{id}', [ClientesController::class, 'destroy'])->name('clientes.destroy');

// ---------------------------
// VENTAS (CRUD)
// ---------------------------
Route::get('/ventas/metricas', [VentasController::class, 'metricas'])->name('ventas.metricas');
Route::post('/ventas/metricas/rango', [VentasController::class, 'metricasPorRango'])->name('ventas.metricas.rango');
Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
Route::get('/ventas/create', [VentasController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');
Route::get('/ventas/{id}', [VentasController::class, 'show'])->name('ventas.show');
Route::get('/ventas/{id}/edit', [VentasController::class, 'edit'])->name('ventas.edit');
Route::put('/ventas/{id}', [VentasController::class, 'update'])->name('ventas.update');
Route::delete('/ventas/{id}', [VentasController::class, 'destroy'])->name('ventas.destroy');

// ---------------------------
// COMPRAS (CRUD)
// ---------------------------
Route::get('/compras/metricas', [ComprasController::class, 'metricas'])->name('compras.metricas');
Route::post('/compras/metricas/rango', [ComprasController::class, 'metricasPorRango'])->name('compras.metricas.rango');
Route::get('/compras', [ComprasController::class, 'index'])->name('compras.index');
Route::get('/compras/create', [ComprasController::class, 'create'])->name('compras.create');
Route::post('/compras', [ComprasController::class, 'store'])->name('compras.store');
Route::get('/compras/{id}', [ComprasController::class, 'show'])->name('compras.show');
Route::get('/compras/{id}/edit', [ComprasController::class, 'edit'])->name('compras.edit');
Route::put('/compras/{id}', [ComprasController::class, 'update'])->name('compras.update');
Route::delete('/compras/{id}', [ComprasController::class, 'destroy'])->name('compras.destroy');
