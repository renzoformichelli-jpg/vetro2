<?php

namespace App\Http\Controllers\clientes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClientesController extends Controller
{
    // LISTA
    public function index()
    {
        $clientes = DB::table('clientes')->get();

        // Calcular edad por backend (si no lo hacés en SQL)
        foreach ($clientes as $c) {
            $c->edad = Carbon::parse($c->nacimiento)->age;
        }

        return view('clientes.index', compact('clientes'));
    }

    // FORM AGREGAR
    public function create()
    {
        return view('clientes.create');
    }

    // GUARDAR NUEVO
    public function store(Request $request)
    {
        DB::table('clientes')->insert([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'celular' => $request->celular,
            'email' => $request->email,
            'nacimiento' => $request->nacimiento,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('clientes.index');
    }

    // FORM EDITAR
    public function edit($id)
    {
        $cliente = DB::table('clientes')->where('id', $id)->first();

        // Calcular edad
        $cliente->edad = Carbon::parse($cliente->nacimiento)->age;

        return view('clientes.edit', compact('cliente'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        DB::table('clientes')->where('id', $id)->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'dni' => $request->dni,
            'celular' => $request->celular,
            'email' => $request->email,
            'nacimiento' => $request->nacimiento,
            'updated_at' => now()
        ]);

        return redirect()->route('clientes.index');
    }

    // ELIMINAR
    public function destroy($id)
    {
        DB::table('clientes')->where('id', $id)->delete();
        return redirect()->route('clientes.index');
    }
}
