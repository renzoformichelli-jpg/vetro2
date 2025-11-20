<?php

namespace App\Http\Controllers\proveedores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedoresController extends Controller
{
    /**
     * INDEX:
     * Muestra todos los proveedores.
     */
    public function index()
    {
        $proveedores = DB::table('proveedores')->get();
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * CREATE:
     * Muestra el formulario de creación.
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * STORE:
     * Guarda un nuevo proveedor.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'            => 'required|string|max:255',
            'persona_contacto'  => 'nullable|string|max:255',
            'sitio_web'         => 'nullable|string|max:255',
            'celular'           => 'nullable|string|max:20',
            'email'             => 'nullable|email|max:255',
        ]);

        DB::table('proveedores')->insert([
            'nombre'           => $request->nombre,
            'persona_contacto' => $request->persona_contacto,
            'sitio_web'        => $request->sitio_web,
            'celular'          => $request->celular,
            'email'            => $request->email,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor creado correctamente.');
    }

    /**
     * EDIT:
     * Muestra el formulario para editar un proveedor.
     */
    public function edit($id)
    {
        $proveedor = DB::table('proveedores')->where('id', $id)->first();
        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * UPDATE:
     * Actualiza un proveedor existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'            => 'required|string|max:255',
            'persona_contacto'  => 'nullable|string|max:255',
            'sitio_web'         => 'nullable|string|max:255',
            'celular'           => 'nullable|string|max:20',
            'email'             => 'nullable|email|max:255',
        ]);

        DB::table('proveedores')->where('id', $id)->update([
            'nombre'           => $request->nombre,
            'persona_contacto' => $request->persona_contacto,
            'sitio_web'        => $request->sitio_web,
            'celular'          => $request->celular,
            'email'            => $request->email,
            'updated_at'       => now(),
        ]);

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor actualizado correctamente.');
    }

    /**
     * DESTROY:
     * Elimina un proveedor.
     */
    public function destroy($id)
    {
        DB::table('proveedores')->where('id', $id)->delete();

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor eliminado correctamente.');
    }
}
