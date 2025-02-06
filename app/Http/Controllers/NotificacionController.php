<?php

namespace App\Http\Controllers;

use App\Mail\NotificarPago;
use App\Models\Configuracion;
use App\Models\Notificacion;
use App\Models\Pago;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NotificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener la configuración más reciente
        $configuracion = Configuracion::latest()->first();

        // Obtener la fecha actual
        $fechaActual = Carbon::now()->toDateString(); // Solo la fecha en formato Y-m-d

        // Consultar todos los pagos pendientes (sin fecha de cancelación) y vencidos
        $pagos = Pago::whereNull('fecha_cancelado')
            ->whereDate('fecha_pago', '<=', $fechaActual) // Comparar solo la fecha
            ->get();

        // Filtrar pagos por rangos de vencimiento
        $pagos30 = $pagos->filter(function ($pago) use ($fechaActual) {
            $fechaPago = Carbon::parse($pago->fecha_pago);
            return $fechaPago->diffInDays($fechaActual) <= 30;
        });

        $pagos60 = $pagos->filter(function ($pago) use ($fechaActual) {
            $fechaPago = Carbon::parse($pago->fecha_pago);
            return $fechaPago->diffInDays($fechaActual) > 30 && $fechaPago->diffInDays($fechaActual) <= 60;
        });

        $pagos90 = $pagos->filter(function ($pago) use ($fechaActual) {
            $fechaPago = Carbon::parse($pago->fecha_pago);
            return $fechaPago->diffInDays($fechaActual) > 60 && $fechaPago->diffInDays($fechaActual) <= 90;
        });

        $pagos120 = $pagos->filter(function ($pago) use ($fechaActual) {
            $fechaPago = Carbon::parse($pago->fecha_pago);
            return $fechaPago->diffInDays($fechaActual) > 90 && $fechaPago->diffInDays($fechaActual) <= 120;
        });

        $pagosMas120 = $pagos->filter(function ($pago) use ($fechaActual) {
            $fechaPago = Carbon::parse($pago->fecha_pago);
            return $fechaPago->diffInDays($fechaActual) > 120;
        });


        return view('admin.notificaciones.index', compact(
            'pagos',
            'pagos30',
            'pagos60',
            'pagos90',
            'pagos120',
            'pagosMas120',
            'configuracion'
        ));
    }

    public function notificar($id)
    {
        $pago = Pago::findOrFail($id);
        Mail::to($pago->prestamo->cliente->email)->send(new NotificarPago($pago));

        return redirect()->route('admin.notificaciones.index')
            ->with('mensaje', 'Se envió la notificación satisfactoriamente.')
            ->with('icono', 'success');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Notificacion $notificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notificacion $notificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notificacion $notificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notificacion $notificacion)
    {
        //
    }
}
