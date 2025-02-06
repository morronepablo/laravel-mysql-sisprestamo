@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Notificaciones</b></h1>
    <hr>
@stop

@section('content')

    <!-- Mora 30 -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <h3 class="card-title my-1">Notificación con mora a 30 días</h3>
                </div>

                <div class="card-body">
                    <table id="pagos30-table" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">Nro.</th>
                                <th scope="col" class="text-center">Documento</th>
                                <th scope="col" class="text-center">Cliente</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Celular</th>
                                <th scope="col" class="text-center">Referencia</th>
                                <th scope="col" class="text-center">Cuota Pagada</th>
                                <th scope="col" class="text-center">N° Cuotas</th>
                                <th scope="col" class="text-center">Fecha a Pagar</th>
                                <th scope="col" class="text-center">Días de Mora</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($pagos30 as $pago)
                                <tr>
                                    <th scope="row" class="text-center">{{ $contador++ }}</th>
                                    <td class="text-center">
                                        {{ number_format($pago->prestamo->cliente->nro_documento, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $pago->prestamo->cliente->nombre . ', ' . $pago->prestamo->cliente->apellido }}
                                    <td>{{ $pago->prestamo->cliente->email }}
                                    <td>{{ $pago->prestamo->cliente->celular }}
                                    <td>{{ $pago->prestamo->cliente->ref_celular }}
                                    </td>
                                    <td class="text-right">$ {{ number_format($pago->monto_pagado, 2, ',', '.') }}</td>
                                    <td>{{ $pago->referencia_pago }}</td>
                                    @if ($pago->fecha_pago == date('Y-m-d'))
                                        <td class="text-center bg-warning">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @elseif($pago->fecha_pago < date('Y-m-d'))
                                        <td class="text-center bg-danger">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @else
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @endif
                                    <!-- Columna de días de mora con badge -->
                                    <td class="text-center">
                                        @php
                                            // Calcular los días de mora
                                            $fechaPago = \Carbon\Carbon::parse($pago->fecha_pago);
                                            $hoy = \Carbon\Carbon::now();
                                            $diasMora = $fechaPago->isPast() ? $hoy->diffInDays($fechaPago) : 0;

                                            // Determinar el color del badge según los días de mora
                                            $badgeClass = '';
                                            if ($diasMora == 0) {
                                                $badgeClass = 'bg-success'; // Verde para 0 días de mora
                                            } elseif ($diasMora <= 5) {
                                                $badgeClass = 'bg-warning'; // Amarillo para pocos días de mora
                                            } else {
                                                $badgeClass = 'bg-danger'; // Rojo para muchos días de mora
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $diasMora }}</span>
                                    </td>
                                    <!-- Botones Acciones -->
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="https://wa.me/{{ $pago->prestamo->cliente->celular }}?text=Hola cliente, {{ $pago->prestamo->cliente->nombre . ', ' . $pago->prestamo->cliente->apellido }}, usted tiene una cuota atrasada, por favor realize el pago lo más antes posible. Atte: {{ $configuracion->nombre }}"
                                                class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Notificar deuda" target="_blank">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                            <form action="{{ route('admin.notificaciones.notificar', $pago->id) }}"
                                                method="GET" onclick="notificar{{ $pago->id }}(event)"
                                                id="miFormulario{{ $pago->id }}">
                                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Enviar Correo"
                                                    style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function notificar{{ $pago->id }}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        position: "center",
                                                        icon: "success",
                                                        title: "Se envió la notificación satisfactoriamente.",
                                                        showConfirmButton: false,
                                                        timer: 2500
                                                    }).then((result) => {
                                                        var form = $('#miFormulario{{ $pago->id }}');
                                                        form.submit();
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Mora 60 -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title my-1">Notificación con mora a 60 días</h3>
                </div>

                <div class="card-body">
                    <table id="pagos60-table" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">Nro.</th>
                                <th scope="col" class="text-center">Documento</th>
                                <th scope="col" class="text-center">Cliente</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Celular</th>
                                <th scope="col" class="text-center">Referencia</th>
                                <th scope="col" class="text-center">Cuota Pagada</th>
                                <th scope="col" class="text-center">N° Cuotas</th>
                                <th scope="col" class="text-center">Fecha a Pagar</th>
                                <th scope="col" class="text-center">Días de Mora</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($pagos60 as $pago)
                                <tr>
                                    <th scope="row" class="text-center">{{ $contador++ }}</th>
                                    <td class="text-center">
                                        {{ number_format($pago->prestamo->cliente->nro_documento, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $pago->prestamo->cliente->nombre . ', ' . $pago->prestamo->cliente->apellido }}
                                    <td>{{ $pago->prestamo->cliente->email }}
                                    <td>{{ $pago->prestamo->cliente->celular }}
                                    <td>{{ $pago->prestamo->cliente->ref_celular }}
                                    </td>
                                    <td class="text-right">$ {{ number_format($pago->monto_pagado, 2, ',', '.') }}</td>
                                    <td>{{ $pago->referencia_pago }}</td>
                                    @if ($pago->fecha_pago == date('Y-m-d'))
                                        <td class="text-center bg-warning">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @elseif($pago->fecha_pago < date('Y-m-d'))
                                        <td class="text-center bg-danger">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @else
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @endif
                                    <!-- Columna de días de mora con badge -->
                                    <td class="text-center">
                                        @php
                                            // Calcular los días de mora
                                            $fechaPago = \Carbon\Carbon::parse($pago->fecha_pago);
                                            $hoy = \Carbon\Carbon::now();
                                            $diasMora = $fechaPago->isPast() ? $hoy->diffInDays($fechaPago) : 0;

                                            // Determinar el color del badge según los días de mora
                                            $badgeClass = '';
                                            if ($diasMora == 0) {
                                                $badgeClass = 'bg-success'; // Verde para 0 días de mora
                                            } elseif ($diasMora <= 5) {
                                                $badgeClass = 'bg-warning'; // Amarillo para pocos días de mora
                                            } else {
                                                $badgeClass = 'bg-danger'; // Rojo para muchos días de mora
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $diasMora }}</span>
                                    </td>
                                    <!-- Botones Acciones -->
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="https://wa.me/{{ $pago->prestamo->cliente->celular }}?text=Hola cliente, {{ $pago->prestamo->cliente->nombre . ', ' . $pago->prestamo->cliente->apellido }}, usted tiene una cuota atrasada, por favor realize el pago lo más antes posible. Atte: {{ $configuracion->nombre }}"
                                                class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Notificar deuda" target="_blank">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                            <form action="{{ route('admin.notificaciones.notificar', $pago->id) }}"
                                                method="GET" onclick="notificar{{ $pago->id }}(event)"
                                                id="miFormulario{{ $pago->id }}">
                                                <button type="button" class="btn btn-info btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Enviar Correo"
                                                    style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function notificar{{ $pago->id }}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        position: "center",
                                                        icon: "success",
                                                        title: "Se envió la notificación satisfactoriamente.",
                                                        showConfirmButton: false,
                                                        timer: 2500
                                                    }).then((result) => {
                                                        var form = $('#miFormulario{{ $pago->id }}');
                                                        form.submit();
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Mora 90 -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title my-1">Notificación con mora a 90 días</h3>
                </div>

                <div class="card-body">
                    <table id="pagos90-table" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">Nro.</th>
                                <th scope="col" class="text-center">Documento</th>
                                <th scope="col" class="text-center">Cliente</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Celular</th>
                                <th scope="col" class="text-center">Referencia</th>
                                <th scope="col" class="text-center">Cuota Pagada</th>
                                <th scope="col" class="text-center">N° Cuotas</th>
                                <th scope="col" class="text-center">Fecha a Pagar</th>
                                <th scope="col" class="text-center">Días de Mora</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($pagos90 as $pago)
                                <tr>
                                    <th scope="row" class="text-center">{{ $contador++ }}</th>
                                    <td class="text-center">
                                        {{ number_format($pago->prestamo->cliente->nro_documento, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $pago->prestamo->cliente->nombre . ', ' . $pago->prestamo->cliente->apellido }}
                                    <td>{{ $pago->prestamo->cliente->email }}
                                    <td>{{ $pago->prestamo->cliente->celular }}
                                    <td>{{ $pago->prestamo->cliente->ref_celular }}
                                    </td>
                                    <td class="text-right">$ {{ number_format($pago->monto_pagado, 2, ',', '.') }}</td>
                                    <td>{{ $pago->referencia_pago }}</td>
                                    @if ($pago->fecha_pago == date('Y-m-d'))
                                        <td class="text-center bg-warning">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @elseif($pago->fecha_pago < date('Y-m-d'))
                                        <td class="text-center bg-danger">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @else
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @endif
                                    <!-- Columna de días de mora con badge -->
                                    <td class="text-center">
                                        @php
                                            // Calcular los días de mora
                                            $fechaPago = \Carbon\Carbon::parse($pago->fecha_pago);
                                            $hoy = \Carbon\Carbon::now();
                                            $diasMora = $fechaPago->isPast() ? $hoy->diffInDays($fechaPago) : 0;

                                            // Determinar el color del badge según los días de mora
                                            $badgeClass = '';
                                            if ($diasMora == 0) {
                                                $badgeClass = 'bg-success'; // Verde para 0 días de mora
                                            } elseif ($diasMora <= 5) {
                                                $badgeClass = 'bg-warning'; // Amarillo para pocos días de mora
                                            } else {
                                                $badgeClass = 'bg-danger'; // Rojo para muchos días de mora
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $diasMora }}</span>
                                    </td>
                                    <!-- Botones Acciones -->
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="https://wa.me/{{ $pago->prestamo->cliente->celular }}?text=Hola cliente, {{ $pago->prestamo->cliente->nombre . ', ' . $pago->prestamo->cliente->apellido }}, usted tiene una cuota atrasada, por favor realize el pago lo más antes posible. Atte: {{ $configuracion->nombre }}"
                                                class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Notificar deuda" target="_blank">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                            <form action="{{ route('admin.notificaciones.notificar', $pago->id) }}"
                                                method="GET" onclick="notificar{{ $pago->id }}(event)"
                                                id="miFormulario{{ $pago->id }}">
                                                <button type="button" class="btn btn-info btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Enviar Correo"
                                                    style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function notificar{{ $pago->id }}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        position: "center",
                                                        icon: "success",
                                                        title: "Se envió la notificación satisfactoriamente.",
                                                        showConfirmButton: false,
                                                        timer: 2500
                                                    }).then((result) => {
                                                        var form = $('#miFormulario{{ $pago->id }}');
                                                        form.submit();
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Mora 120 -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-warning">
                <div class="card-header">
                    <h3 class="card-title my-1">Notificación con mora a 120 días</h3>
                </div>

                <div class="card-body">
                    <table id="pagos120-table" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">Nro.</th>
                                <th scope="col" class="text-center">Documento</th>
                                <th scope="col" class="text-center">Cliente</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Celular</th>
                                <th scope="col" class="text-center">Referencia</th>
                                <th scope="col" class="text-center">Cuota Pagada</th>
                                <th scope="col" class="text-center">N° Cuotas</th>
                                <th scope="col" class="text-center">Fecha a Pagar</th>
                                <th scope="col" class="text-center">Días de Mora</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($pagos120 as $pago)
                                <tr>
                                    <th scope="row" class="text-center">{{ $contador++ }}</th>
                                    <td class="text-center">
                                        {{ number_format($pago->prestamo->cliente->nro_documento, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $pago->prestamo->cliente->nombre . ', ' . $pago->prestamo->cliente->apellido }}
                                    <td>{{ $pago->prestamo->cliente->email }}
                                    <td>{{ $pago->prestamo->cliente->celular }}
                                    <td>{{ $pago->prestamo->cliente->ref_celular }}
                                    </td>
                                    <td class="text-right">$ {{ number_format($pago->monto_pagado, 2, ',', '.') }}</td>
                                    <td>{{ $pago->referencia_pago }}</td>
                                    @if ($pago->fecha_pago == date('Y-m-d'))
                                        <td class="text-center bg-warning">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @elseif($pago->fecha_pago < date('Y-m-d'))
                                        <td class="text-center bg-danger">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @else
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @endif
                                    <!-- Columna de días de mora con badge -->
                                    <td class="text-center">
                                        @php
                                            // Calcular los días de mora
                                            $fechaPago = \Carbon\Carbon::parse($pago->fecha_pago);
                                            $hoy = \Carbon\Carbon::now();
                                            $diasMora = $fechaPago->isPast() ? $hoy->diffInDays($fechaPago) : 0;

                                            // Determinar el color del badge según los días de mora
                                            $badgeClass = '';
                                            if ($diasMora == 0) {
                                                $badgeClass = 'bg-success'; // Verde para 0 días de mora
                                            } elseif ($diasMora <= 5) {
                                                $badgeClass = 'bg-warning'; // Amarillo para pocos días de mora
                                            } else {
                                                $badgeClass = 'bg-danger'; // Rojo para muchos días de mora
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $diasMora }}</span>
                                    </td>
                                    <!-- Botones Acciones -->
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="https://wa.me/{{ $pago->prestamo->cliente->celular }}?text=Hola cliente, {{ $pago->prestamo->cliente->nombre . ', ' . $pago->prestamo->cliente->apellido }}, usted tiene una cuota atrasada, por favor realize el pago lo más antes posible. Atte: {{ $configuracion->nombre }}"
                                                class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Notificar deuda" target="_blank">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                            <form action="{{ route('admin.notificaciones.notificar', $pago->id) }}"
                                                method="GET" onclick="notificar{{ $pago->id }}(event)"
                                                id="miFormulario{{ $pago->id }}">
                                                <button type="button" class="btn btn-info btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Enviar Correo"
                                                    style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function notificar{{ $pago->id }}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        position: "center",
                                                        icon: "success",
                                                        title: "Se envió la notificación satisfactoriamente.",
                                                        showConfirmButton: false,
                                                        timer: 2500
                                                    }).then((result) => {
                                                        var form = $('#miFormulario{{ $pago->id }}');
                                                        form.submit();
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Mora Mas 120 -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title my-1">Notificación con mora mayor a 120 días</h3>
                </div>

                <div class="card-body">
                    <table id="pagosMas120-table" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">Nro.</th>
                                <th scope="col" class="text-center">Documento</th>
                                <th scope="col" class="text-center">Cliente</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Celular</th>
                                <th scope="col" class="text-center">Referencia</th>
                                <th scope="col" class="text-center">Cuota Pagada</th>
                                <th scope="col" class="text-center">N° Cuotas</th>
                                <th scope="col" class="text-center">Fecha a Pagar</th>
                                <th scope="col" class="text-center">Días de Mora</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($pagosMas120 as $pago)
                                <tr>
                                    <th scope="row" class="text-center">{{ $contador++ }}</th>
                                    <td class="text-center">
                                        {{ number_format($pago->prestamo->cliente->nro_documento, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $pago->prestamo->cliente->nombre . ', ' . $pago->prestamo->cliente->apellido }}
                                    <td>{{ $pago->prestamo->cliente->email }}
                                    <td>{{ $pago->prestamo->cliente->celular }}
                                    <td>{{ $pago->prestamo->cliente->ref_celular }}
                                    </td>
                                    <td class="text-right">$ {{ number_format($pago->monto_pagado, 2, ',', '.') }}</td>
                                    <td>{{ $pago->referencia_pago }}</td>
                                    @if ($pago->fecha_pago == date('Y-m-d'))
                                        <td class="text-center bg-warning">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @elseif($pago->fecha_pago < date('Y-m-d'))
                                        <td class="text-center bg-danger">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @else
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                        </td>
                                    @endif
                                    <!-- Columna de días de mora con badge -->
                                    <td class="text-center">
                                        @php
                                            // Calcular los días de mora
                                            $fechaPago = \Carbon\Carbon::parse($pago->fecha_pago);
                                            $hoy = \Carbon\Carbon::now();
                                            $diasMora = $fechaPago->isPast() ? $hoy->diffInDays($fechaPago) : 0;

                                            // Determinar el color del badge según los días de mora
                                            $badgeClass = '';
                                            if ($diasMora == 0) {
                                                $badgeClass = 'bg-success'; // Verde para 0 días de mora
                                            } elseif ($diasMora <= 5) {
                                                $badgeClass = 'bg-warning'; // Amarillo para pocos días de mora
                                            } else {
                                                $badgeClass = 'bg-danger'; // Rojo para muchos días de mora
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ $diasMora }}</span>
                                    </td>
                                    <!-- Botones Acciones -->
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="https://wa.me/{{ $pago->prestamo->cliente->celular }}?text=Hola cliente, {{ $pago->prestamo->cliente->nombre . ', ' . $pago->prestamo->cliente->apellido }}, usted tiene una cuota atrasada, por favor realize el pago lo más antes posible. Atte: {{ $configuracion->nombre }}"
                                                class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Notificar deuda" target="_blank">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                            <form action="{{ route('admin.notificaciones.notificar', $pago->id) }}"
                                                method="GET" onclick="notificar{{ $pago->id }}(event)"
                                                id="miFormulario{{ $pago->id }}">
                                                <button type="button" class="btn btn-info btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Enviar Correo"
                                                    style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                            </form>
                                            <script>
                                                function notificar{{ $pago->id }}(event) {
                                                    event.preventDefault();
                                                    Swal.fire({
                                                        position: "center",
                                                        icon: "success",
                                                        title: "Se envió la notificación satisfactoriamente.",
                                                        showConfirmButton: false,
                                                        timer: 2500
                                                    }).then((result) => {
                                                        var form = $('#miFormulario{{ $pago->id }}');
                                                        form.submit();
                                                    });
                                                }
                                            </script>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@stop

@section('adminlte_css')
    <style>
        /* Redondeado menos pronunciado */
        .btn.rounded-sm {
            border-radius: 5px !important;
            /* Ajusta este valor para cambiar el redondeado */
        }

        /* Separación entre botones */
        .btn.rounded-sm {
            margin-right: 10px;
            /* Añade 20px de separación entre botones */
        }

        /* Eliminar el margen del último botón para evitar espacio innecesario */
        .btn.rounded-sm:last-child {
            margin-right: 0;
        }

        /* Espacio entre los botones y el header del DataTable */
        #pagos30-table_wrapper .dt-buttons {
            margin-bottom: 20px;
            /* Añade 20px de espacio debajo de los botones */
        }

        #pagos60-table_wrapper .dt-buttons {
            margin-bottom: 20px;
            /* Añade 20px de espacio debajo de los botones */
        }

        #pagos90-table_wrapper .dt-buttons {
            margin-bottom: 20px;
            /* Añade 20px de espacio debajo de los botones */
        }

        #pagos120-table_wrapper .dt-buttons {
            margin-bottom: 20px;
            /* Añade 20px de espacio debajo de los botones */
        }

        #pagosMas120-table_wrapper .dt-buttons {
            margin-bottom: 20px;
            /* Añade 20px de espacio debajo de los botones */
        }


        /* Cambiar intensidad del color en hover */
        .btn-secondary:hover {
            filter: brightness(90%);
        }

        .btn-danger:hover {
            filter: brightness(90%);
        }

        .btn-info:hover {
            filter: brightness(90%);
        }

        .btn-success:hover {
            filter: brightness(90%);
        }

        .btn-warning:hover {
            filter: brightness(90%);
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .no-left-radius {
            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }

        input:disabled {
            background-color: rgb(219, 248, 191) !important;
            color: #277608 !important;
        }


        .input-group-text {
            background-color: black !important;
            color: white !important;
            border: none !important;
        }

        /* Estilos base para Select2 */
        .select2-container .select2-selection--single {
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            display: flex;
            /* Añadido para centrar contenido */
            align-items: center;
            /* Centrar verticalmente */
        }

        /* Ajustar el contenedor del texto */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: calc(1.5em + .75rem + 2px) !important;
            /* Centrar verticalmente */
            padding: 0 !important;
            /* Eliminar padding interno */
            width: 100%;
            /* Asegurar que ocupe todo el ancho */
        }

        /* Ajustar el placeholder */
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6c757d;
            /* Color del placeholder */
            line-height: normal !important;
            /* Resetear line-height */
            display: inline-block;
            /* Cambiar a inline-block */
            vertical-align: middle;
            /* Centrar verticalmente */
        }

        /* Ajustar la flecha del Select2 */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(1.5em + .75rem + 2px);
            display: flex;
            align-items: center;
            /* Centrar verticalmente */
        }
    </style>

    @stack('css')
    @yield('css')
@stop

@section('adminlte_js')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = $('#pagos30-table').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ pagos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 pagos",
                    "infoFiltered": "(Filtrado de _MAX_ total pagos)",
                    "lengthMenu": "Mostrar _MENU_ pagos",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron pagos",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "dom": '<"row"<"col-md-6"l><"col-md-6 text-right"f>><"row"<"col-md-12"B>>rt<"row"<"col-md-6"i><"col-md-6 text-right"p>>',
                buttons: [{
                        text: '<i class="fas fa-copy"></i> Copiar',
                        extend: 'copy',
                        className: 'btn btn-secondary rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        extend: 'pdf',
                        className: 'btn btn-danger rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        extend: 'csv',
                        className: 'btn btn-info rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        extend: 'excel',
                        className: 'btn btn-success rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-print"></i> Imprimir',
                        extend: 'print',
                        className: 'btn btn-warning rounded-sm'
                    }
                ]
            });

            // Colocar los botones dentro del contenedor correcto
            table.buttons().container().appendTo('#pagos30-table_wrapper .col-md-12:eq(1)');

            let table60 = $('#pagos60-table').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ pagos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 pagos",
                    "infoFiltered": "(Filtrado de _MAX_ total pagos)",
                    "lengthMenu": "Mostrar _MENU_ pagos",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron pagos",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "dom": '<"row"<"col-md-6"l><"col-md-6 text-right"f>><"row"<"col-md-12"B>>rt<"row"<"col-md-6"i><"col-md-6 text-right"p>>',
                buttons: [{
                        text: '<i class="fas fa-copy"></i> Copiar',
                        extend: 'copy',
                        className: 'btn btn-secondary rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        extend: 'pdf',
                        className: 'btn btn-danger rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        extend: 'csv',
                        className: 'btn btn-info rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        extend: 'excel',
                        className: 'btn btn-success rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-print"></i> Imprimir',
                        extend: 'print',
                        className: 'btn btn-warning rounded-sm'
                    }
                ]
            });

            // Colocar los botones dentro del contenedor correcto
            table60.buttons().container().appendTo('#pagos60-table_wrapper .col-md-12:eq(1)');

            let table90 = $('#pagos90-table').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ pagos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 pagos",
                    "infoFiltered": "(Filtrado de _MAX_ total pagos)",
                    "lengthMenu": "Mostrar _MENU_ pagos",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron pagos",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "dom": '<"row"<"col-md-6"l><"col-md-6 text-right"f>><"row"<"col-md-12"B>>rt<"row"<"col-md-6"i><"col-md-6 text-right"p>>',
                buttons: [{
                        text: '<i class="fas fa-copy"></i> Copiar',
                        extend: 'copy',
                        className: 'btn btn-secondary rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        extend: 'pdf',
                        className: 'btn btn-danger rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        extend: 'csv',
                        className: 'btn btn-info rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        extend: 'excel',
                        className: 'btn btn-success rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-print"></i> Imprimir',
                        extend: 'print',
                        className: 'btn btn-warning rounded-sm'
                    }
                ]
            });

            // Colocar los botones dentro del contenedor correcto
            table90.buttons().container().appendTo('#pagos90-table_wrapper .col-md-12:eq(1)');

            let table120 = $('#pagos120-table').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ pagos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 pagos",
                    "infoFiltered": "(Filtrado de _MAX_ total pagos)",
                    "lengthMenu": "Mostrar _MENU_ pagos",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron pagos",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "dom": '<"row"<"col-md-6"l><"col-md-6 text-right"f>><"row"<"col-md-12"B>>rt<"row"<"col-md-6"i><"col-md-6 text-right"p>>',
                buttons: [{
                        text: '<i class="fas fa-copy"></i> Copiar',
                        extend: 'copy',
                        className: 'btn btn-secondary rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        extend: 'pdf',
                        className: 'btn btn-danger rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        extend: 'csv',
                        className: 'btn btn-info rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        extend: 'excel',
                        className: 'btn btn-success rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-print"></i> Imprimir',
                        extend: 'print',
                        className: 'btn btn-warning rounded-sm'
                    }
                ]
            });

            // Colocar los botones dentro del contenedor correcto
            table120.buttons().container().appendTo('#pagos120-table_wrapper .col-md-12:eq(1)');

            let tableMas120 = $('#pagosMas120-table').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ pagos",
                    "infoEmpty": "Mostrando 0 a 0 de 0 pagos",
                    "infoFiltered": "(Filtrado de _MAX_ total pagos)",
                    "lengthMenu": "Mostrar _MENU_ pagos",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron pagos",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "dom": '<"row"<"col-md-6"l><"col-md-6 text-right"f>><"row"<"col-md-12"B>>rt<"row"<"col-md-6"i><"col-md-6 text-right"p>>',
                buttons: [{
                        text: '<i class="fas fa-copy"></i> Copiar',
                        extend: 'copy',
                        className: 'btn btn-secondary rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-pdf"></i> PDF',
                        extend: 'pdf',
                        className: 'btn btn-danger rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-csv"></i> CSV',
                        extend: 'csv',
                        className: 'btn btn-info rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        extend: 'excel',
                        className: 'btn btn-success rounded-sm'
                    },
                    {
                        text: '<i class="fas fa-print"></i> Imprimir',
                        extend: 'print',
                        className: 'btn btn-warning rounded-sm'
                    }
                ]
            });

            // Colocar los botones dentro del contenedor correcto
            tableMas120.buttons().container().appendTo('#pagosMas120-table_wrapper .col-md-12:eq(1)');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>


    @stack('js')
    @yield('js')
@stop
