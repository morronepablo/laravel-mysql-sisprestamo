@extends('adminlte::page')

@section('content_header')
    <h1><b>Datos del pago</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">

        {{-- Datos del cliente --}}
        <div class="col-md-4">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos del cliente</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <i class="fas fa-id-card"></i>
                                {{ number_format($prestamo->cliente->nro_documento, 0, ',', '.') }} <br><br>
                                <i class="fas fa-user"></i>
                                {{ $prestamo->cliente->apellido . ', ' . $prestamo->cliente->nombre }} <br><br>
                                <i class="fas fa-calendar"></i>
                                {{ \Carbon\Carbon::parse($prestamo->cliente->fecha_nacimiento)->format('d/m/Y') }} <br><br>
                                <i class="fas fa-user-check"></i> {{ $prestamo->cliente->genero }} <br><br>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <i class="fas fa-envelope"></i> {{ $prestamo->cliente->email }} <br><br>
                                <i class="fas fa-phone"></i> {{ $prestamo->cliente->celular }} <br><br>
                                <i class="fas fa-phone"></i> {{ $prestamo->cliente->ref_celular }} <br><br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Datos del préstamo --}}
        <div class="col-md-3">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Datos del préstamo</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <b>Monto prestado</b> <br>
                                <i class="fas fa-hand-holding-usd"></i> $
                                {{ number_format($prestamo->monto_prestado, 2, ',', '.') }}
                                <br><br>

                                <b>Tasa de interés</b> <br>
                                <i class="fas fa-percent"></i> {{ $prestamo->tasa_interes }}
                                <br><br>

                                <b>Modalidad</b> <br>
                                <i class="fas fa-calendar-alt"></i> {{ $prestamo->modalidad }}
                                <br><br>
                            </p>
                        </div>

                        <div class="col-md-6">
                            <p>
                                <b>N° de cuotas</b> <br>
                                <i class="fas fa-list-ol"></i> {{ $prestamo->nro_cuotas }}<br><br>

                                <b>Monto total</b> <br>
                                <i class="fas fa-money-bill-wave"></i> $
                                {{ number_format($prestamo->monto_total, 2, ',', '.') }}
                                <br><br>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- Datos de los pagos --}}
        <div class="col-md-5">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title">Datos del pago</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <!-- Primera columna -->
                                <div class="col-md-6">
                                    <p>
                                        <b>Monto Pagado: </b>$ {{ number_format($pago->monto_pagado, 2, ',', '.') }}
                                        <br><br>
                                        <b>Método de Pago: </b>{{ $pago->metodo_pago }} <br><br>
                                        <b>Pago de la cuota:</b>
                                        @php
                                            // Extraer solo el número de la cuota
                                            $numeroCuota = preg_replace('/[^0-9]/', '', $pago->referencia_pago);
                                        @endphp
                                        {{ $numeroCuota }} <br><br>
                                    </p>
                                </div>

                                <!-- Segunda columna -->
                                <div class="col-md-6">
                                    <p>
                                        <b>Estado de Pago: </b>{{ $pago->estado }} <br><br>
                                        <b>Fecha Cancelación: </b>
                                        {{ $pago->fecha_cancelado ? \Carbon\Carbon::parse($pago->fecha_cancelado)->format('d/m/Y') : '' }}
                                        <br><br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <hr>

    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <a href="{{ route('admin.pagos.index') }}"class="btn btn-secondary text-white text-decoration-none">
                <i class="fas fa-reply"></i> Volver
            </a>
        </div>
    </div>

@stop

@section('css')

@stop

@section('js')

@stop
