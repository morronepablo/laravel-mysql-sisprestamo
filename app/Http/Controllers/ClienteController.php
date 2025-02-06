<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all()->sortByDesc('id');
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datos = request()->all();
        // return response()->json($datos);
        $request->validate([
            'nro_documento' => 'required|unique:clientes',
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'email' => 'required|unique:clientes',
            'celular' => 'required',
            'ref_celular' => 'required',
        ]);

        $cliente = new Cliente();

        $cliente->nro_documento = $request->nro_documento;
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->fecha_nacimiento = $request->fecha_nacimiento;
        $cliente->genero = $request->genero;
        $cliente->email = $request->email;
        $cliente->celular = $request->celular;
        $cliente->ref_celular = $request->ref_celular;

        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Se registró el cliente satisfactoriamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nro_documento' => 'required|unique:clientes,nro_documento,' . $id,
            'nombre' => 'required',
            'apellido' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required',
            'email' => 'required|unique:clientes,email,' . $id,
            'celular' => 'required',
            'ref_celular' => 'required',
        ]);

        $cliente = Cliente::findOrFail($id);;

        $cliente->nro_documento = $request->nro_documento;
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->fecha_nacimiento = $request->fecha_nacimiento;
        $cliente->genero = $request->genero;
        $cliente->email = $request->email;
        $cliente->celular = $request->celular;
        $cliente->ref_celular = $request->ref_celular;

        $cliente->save();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Se actualizó el cliente satisfactoriamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('admin.clientes.index')
            ->with('mensaje', 'Se eliminó el cliente satisfactoriamente.')
            ->with('icono', 'success');
    }
}
