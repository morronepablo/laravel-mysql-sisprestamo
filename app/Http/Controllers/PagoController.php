<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Configuracion;
use App\Models\Pago;
use App\Models\Prestamo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        $pagos = Pago::whereNotNull('fecha_cancelado')->orderBy('fecha_cancelado', 'desc')->get();

        return view('admin.pagos.index', compact('pagos', 'clientes'));
    }

    public function cargar_prestamo_cliente($id)
    {
        $cliente = Cliente::findOrFail($id);
        $prestamos = Prestamo::where('cliente_id', $cliente->id)->get();
        return view('admin.pagos.cargar_prestamo_cliente', compact('cliente', 'prestamos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $prestamo = Prestamo::findOrFail($id);
        $pagos = Pago::where('prestamo_id', $id)->get();
        return view('admin.pagos.create', compact('prestamo', 'pagos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        // $datos = request()->all();
        // return response()->json($datos);
        $pago = Pago::findOrFail($id);
        $pago->metodo_pago = $request->metodo_pago;
        $pago->estado = "Confirmado";
        $pago->fecha_cancelado = date('Y-m-d');
        $pago->save();

        $total_cuotas_faltantes = Pago::where('prestamo_id', $pago->prestamo->id)
            ->where('estado', 'Pendiente')
            ->count();
        if ($total_cuotas_faltantes == 0) {
            $prestamo = Prestamo::findOrFail($pago->prestamo->id);
            $prestamo->estado = "Cancelado";
            $prestamo->save();
        }

        return redirect()->back()
            ->with('mensaje', 'Se registró el pago satisfactoriamente.')
            ->with('icono', 'success');
    }

    public function comprobantedepago($id)
    {
        $configuracion = Configuracion::latest()->first();
        $pago = Pago::findOrFail($id);
        $prestamo = Prestamo::where('id', $pago->prestamo_id)->first();
        $cliente = Cliente::where('id', $prestamo->cliente_id)->first();

        // Configura el idioma para las funciones de localización
        setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain.1252', 'es'); // Asegura el cambio de idioma
        Carbon::setLocale('es');

        // Obtiene la fecha cancelada desde el objeto $pago
        $fecha_cancelado = $pago->fecha_cancelado;
        $fecha = Carbon::parse($fecha_cancelado);

        // Obtiene el día de la semana y el mes en español
        $diaL = $fecha->isoFormat('dddd'); // Día de la semana (ejemplo: "lunes")
        $mes = $fecha->isoFormat('MMMM'); // Mes en español (ejemplo: "enero")

        // Obtiene el día del mes con formato de dos dígitos (ejemplo: "04")
        $diaNumero = $fecha->format('d'); // Formato de dos dígitos

        // Obtiene el año en formato de 4 dígitos (ejemplo: "2023")
        $ano = $fecha->format('Y');

        // Imprime los valores formateados
        $fecha_literal = ucfirst($diaL) . ' ' . $diaNumero . ' de ' . ucfirst($mes) . ' del ' . $ano;

        $pdf = PDF::loadView('admin.pagos.comprobante_pago', compact('pago', 'prestamo', 'cliente', 'configuracion', 'fecha_literal'));
        return $pdf->stream();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pago = Pago::findOrFail($id);
        $prestamo = Prestamo::where('id', $pago->prestamo_id)->first();
        $cliente = Cliente::where('id', $prestamo->cliente_id)->first();

        return view('admin.pagos.show', compact('pago', 'prestamo', 'cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->estado = 'Pendiente';
        $pago->fecha_cancelado = null;
        $pago->save();

        $prestamo = Prestamo::findOrFail($pago->prestamo->id);
        $prestamo->estado = "Pendiente";
        $prestamo->save();

        return redirect()->route('admin.pagos.index')
            ->with('mensaje', 'Se eliminó el pago satisfactoriamente.')
            ->with('icono', 'success');
    }
}
