<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Pago;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestamos = Prestamo::all()->sortByDesc('id');

        foreach ($prestamos as $prestamo) {
            $prestamo->tiene_cuota_pagada = Pago::WhereNotNull('fecha_cancelado')
                ->where('prestamo_id', $prestamo->id)
                ->exists();
        }

        return view('admin.prestamos.index', compact('prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all()->sortByDesc('id');
        return view('admin.prestamos.create', compact('clientes'));
    }

    public function obtenerCliente($id)
    {
        $cliente = Cliente::find($id);
        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado']);
        }

        return response()->json($cliente);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $datos = request()->all();
        // return response()->json($datos);
        $request->validate([
            'cliente_id' => 'required',
            'monto_prestado' => 'required',
            'tasa_interes' => 'required',
            'modalidad' => 'required',
            'nro_cuotas' => 'required',
            'fecha_inicio' => 'required',
            'monto_total' => 'required',
            'monto_cuota' => 'required',
        ]);

        $prestamo = new Prestamo();
        $prestamo->cliente_id = $request->cliente_id;
        $prestamo->monto_prestado = $request->monto_prestado;
        $prestamo->tasa_interes = $request->tasa_interes;
        $prestamo->modalidad = $request->modalidad;
        $prestamo->nro_cuotas = $request->nro_cuotas;
        $prestamo->monto_total = $request->monto_total;
        $prestamo->fecha_inicio = $request->fecha_inicio;
        $prestamo->cliente_id = $request->cliente_id;
        $prestamo->cliente_id = $request->cliente_id;

        $prestamo->save();

        for ($i = 1; $i <= $request->nro_cuotas; $i++) {
            $pago = new Pago();
            $pago->prestamo_id = $prestamo->id;
            $pago->monto_pagado = $request->monto_cuota;

            $fechaInicio = Carbon::parse($request->fechaInicio);
            switch ($request->modalidad) {
                case 'Diario':
                    $fechaVencimiento = $fechaInicio->copy()->addDays($i);
                    break;
                case 'Semanal':
                    $fechaVencimiento = $fechaInicio->copy()->addWeeks($i);
                    break;
                case 'Quincenal':
                    $fechaVencimiento = $fechaInicio->copy()->addWeeks($i * 2 - 1);
                    break;
                case 'Mensual':
                    $fechaVencimiento = $fechaInicio->copy()->addMonth($i);
                    break;
                case 'Anual':
                    $fechaVencimiento = $fechaInicio->copy()->addYears($i);
                    break;
            }

            $pago->fecha_pago = $fechaVencimiento;
            $pago->metodo_pago = "Efectivo";
            $pago->referencia_pago = "Pago de la cuota N°: " . $i;
            $pago->estado = "Pendiente";
            $pago->save();
        }

        return redirect()->route('admin.prestamos.index')
            ->with('mensaje', 'Se registró el préstamo satisfactoriamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prestamo = Prestamo::findOrFail($id);
        $pagos = Pago::where('prestamo_id', $prestamo->id)->get();
        return view('admin.prestamos.show', compact('prestamo', 'pagos'));
    }

    public function contratos($id)
    {
        $configuracion = Configuracion::latest()->first();
        $prestamo = Prestamo::findOrFail($id);
        $pagos = Pago::where('prestamo_id', $prestamo->id)->get();

        $pdf = PDF::loadView('admin.prestamos.contratos', compact('prestamo', 'pagos', 'configuracion'));
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prestamo = Prestamo::findOrFail($id);
        $clientes = Cliente::all()->sortByDesc('id');
        return view('admin.prestamos.edit', compact('prestamo', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // $datos = request()->all();
        // return response()->json($datos);
        $request->validate([
            'cliente_id' => 'required',
            'monto_prestado' => 'required',
            'tasa_interes' => 'required',
            'modalidad' => 'required',
            'nro_cuotas' => 'required',
            'fecha_inicio' => 'required',
            'monto_total' => 'required',
            'monto_cuota' => 'required',
        ]);

        $prestamo = Prestamo::findOrFail($id);
        $prestamo->cliente_id = $request->cliente_id;
        $prestamo->monto_prestado = $request->monto_prestado;
        $prestamo->tasa_interes = $request->tasa_interes;
        $prestamo->modalidad = $request->modalidad;
        $prestamo->nro_cuotas = $request->nro_cuotas;
        $prestamo->monto_total = $request->monto_total;
        $prestamo->fecha_inicio = $request->fecha_inicio;
        $prestamo->cliente_id = $request->cliente_id;
        $prestamo->cliente_id = $request->cliente_id;

        $prestamo->save();

        Pago::where('prestamo_id', $id)->delete();

        for ($i = 1; $i <= $request->nro_cuotas; $i++) {
            $pago = new Pago();
            $pago->prestamo_id = $prestamo->id;
            $pago->monto_pagado = $request->monto_cuota;

            $fechaInicio = Carbon::parse($request->fecha_inicio);
            switch ($request->modalidad) {
                case 'Diario':
                    $fechaVencimiento = $fechaInicio->copy()->addDays($i);
                    break;
                case 'Semanal':
                    $fechaVencimiento = $fechaInicio->copy()->addWeeks($i);
                    break;
                case 'Quincenal':
                    $fechaVencimiento = $fechaInicio->copy()->addWeeks($i * 2 - 1);
                    break;
                case 'Mensual':
                    $fechaVencimiento = $fechaInicio->copy()->addMonth($i);
                    break;
                case 'Anual':
                    $fechaVencimiento = $fechaInicio->copy()->addYears($i);
                    break;
            }

            $pago->fecha_pago = $fechaVencimiento;
            $pago->metodo_pago = "Efectivo";
            $pago->referencia_pago = "Pago de la cuota N°: " . $i;
            $pago->estado = "Pendiente";
            $pago->save();
        }
        return redirect()->route('admin.prestamos.index')
            ->with('mensaje', 'Se actualizó el préstamo satisfactoriamente.')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Pago::where('prestamo_id', $id)->delete();
        Prestamo::destroy($id);

        return redirect()->route('admin.prestamos.index')
            ->with('mensaje', 'Se eliminó el préstamo satisfactoriamente.')
            ->with('icono', 'success');
    }
}
