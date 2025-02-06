@extends('adminlte::page')

@section('content_header')
    <h1><b>Bienvenido</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">

        <!-- Configuraciones -->
        @can('ver-configuracion')
            <div class="col-md-3 col-sm-6 col-12">
                <a href="{{ route('admin.configuracion.index') }}" class="info-box zoomP"
                    style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                    <div class="info-box-icon bg-info">
                        <img src="{{ url('/images/ajustes.gif') }}" width="100%" alt="imagen">
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Configuraciones registradas</span>
                        <span class="info-box-number">
                            {{ $total_configuraciones }}
                            {{ $total_configuraciones === 1 ? 'configuración' : 'configuraciones' }}
                        </span>
                    </div>
                </a>
            </div>
        @endcan

        <!-- Roles -->
        @can('ver-roles')
            <div class="col-md-3 col-sm-6 col-12">
                <a href="{{ route('admin.roles.index') }}" class="info-box zoomP"
                    style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                    <div class="info-box-icon bg-info">
                        <img src="{{ url('/images/roles.gif') }}" width="100%" alt="imagen">
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Roles registrados</span>
                        <span class="info-box-number">
                            {{ $total_roles }}
                            {{ $total_roles === 1 ? 'rol' : 'roles' }}
                        </span>
                    </div>
                </a>
            </div>
        @endcan

        <!-- Usuarios -->
        @can('ver-usuarios')
            <div class="col-md-3 col-sm-6 col-12">
                <a href="{{ route('admin.usuarios.index') }}" class="info-box zoomP"
                    style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                    <div class="info-box-icon bg-info">
                        <img src="{{ url('/images/usuarios.gif') }}" width="100%" alt="imagen">
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Usuarios registrados</span>
                        <span class="info-box-number">
                            {{ $total_usuarios }}
                            {{ $total_usuarios === 1 ? 'usuario' : 'usuarios' }}
                        </span>
                    </div>
                </a>
            </div>
        @endcan

        <!-- Clientes -->
        @can('ver-clientes')
            <div class="col-md-3 col-sm-6 col-12">
                <a href="{{ route('admin.clientes.index') }}" class="info-box zoomP"
                    style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                    <div class="info-box-icon bg-info">
                        <img src="{{ url('/images/clientes.gif') }}" width="100%" alt="imagen">
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Clientes registrados</span>
                        <span class="info-box-number">
                            {{ $total_clientes }}
                            {{ $total_clientes === 1 ? 'cliente' : 'clientes' }}
                        </span>
                    </div>
                </a>
            </div>
        @endcan

        <!-- Prestamos -->
        @can('ver-prestamos')
            <div class="col-md-3 col-sm-6 col-12">
                <a href="{{ route('admin.prestamos.index') }}" class="info-box zoomP"
                    style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                    <div class="info-box-icon bg-info">
                        <img src="{{ url('/images/prestamos.gif') }}" width="100%" alt="imagen">
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Prestamos otorgados</span>
                        <span class="info-box-number">
                            {{ $total_prestamos }}
                            {{ $total_prestamos === 1 ? 'préstamo' : 'prestamos' }}
                        </span>
                    </div>
                </a>
            </div>
        @endcan

        <!-- Pagos -->
        @can('ver-pagos')
            <div class="col-md-3 col-sm-6 col-12">
                <a href="{{ route('admin.pagos.index') }}" class="info-box zoomP"
                    style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                    <div class="info-box-icon bg-info">
                        <img src="{{ url('/images/pagos.gif') }}" width="100%" alt="imagen">
                    </div>
                    <div class="info-box-content">
                        <span class="info-box-text">Pagos registrados</span>
                        <span class="info-box-number">
                            {{ $total_pagos }}
                            {{ $total_pagos === 1 ? 'pago' : 'pagos' }}
                        </span>
                    </div>
                </a>
            </div>
        @endcan

    </div>

    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Total de prestamos por mes</h3>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="chartPrestamos"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="card card-outline card-purple">
                <div class="card-header">
                    <h3 class="card-title">Total de pagos por mes</h3>
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="chartPagos"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .zoomP {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            /* Sombra más visible en estado normal */
            border-radius: 8px;
            /* Opcional para bordes más suaves */
        }

        .zoomP:hover {
            transform: scale(1.05);
            /* Efecto de ampliación */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
            /* Sombra más intensa en hover */
        }
    </style>
@stop

@section('js')

    @php
        $meses = array_fill(1, 12, 0);
        $suma_prestamos = array_fill(1, 12, 0);
        foreach ($prestamos as $prestamo) {
            $fecha = strtotime($prestamo['fecha_inicio']);
            $mes = date('m', $fecha);

            $meses[(int) $mes]++;
            $suma_prestamos[(int) $mes] += $prestamo['monto_prestado'];
        }
        $reporte_prestamo = implode(',', $suma_prestamos);

        // $meses = array_fill(1, 12, 0);
        $suma_pagos = array_fill(1, 12, 0);
        foreach ($pagos as $pago) {
            $fecha = strtotime($pago['fecha_cancelado']);
            $mes = date('m', $fecha);

            $meses[(int) $mes]++;
            $suma_pagos[(int) $mes] += $pago['monto_pagado'];
        }
        $reporte_pago = implode(',', $suma_pagos);

    @endphp


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
                'Octubre',
                'Noviembre', 'Diciembre'
            ];

            // Datos
            var datosPrestamos = [{{ $reporte_prestamo }}];
            var datosPagos = [{{ $reporte_pago }}];

            // Primer gráfico
            new Chart(document.getElementById('chartPrestamos'), {
                type: 'line',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Total de prestamos por mes',
                        data: datosPrestamos,
                        backgroundColor: 'rgba(0, 123, 255, 0.5)',
                        borderColor: 'rgba(0, 123, 255, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Segundo gráfico
            new Chart(document.getElementById('chartPagos'), {
                type: 'bar',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Total de pagos por mes',
                        data: datosPagos,
                        backgroundColor: 'rgba(128, 0, 128, 0.5)',
                        borderColor: 'rgba(128, 0, 128, 1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Tercer gráfico
            new Chart(document.getElementById('myChart3'), {
                type: 'line',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Total cantidad de compras',
                        data: datosCompras,
                        backgroundColor: 'rgba(255, 206, 86, 0.5)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Cuarto gráfico
            new Chart(document.getElementById('myChart4'), {
                type: 'bar',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Total compras en $',
                        data: datosMonetizadosCompras,
                        backgroundColor: 'rgba(75, 192, 75, 0.5)',
                        borderColor: 'rgba(75, 192, 75, 1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@stop
