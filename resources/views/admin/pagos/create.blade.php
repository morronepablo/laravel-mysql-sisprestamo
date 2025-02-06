@extends('adminlte::page')

@section('content_header')
    <h1><b>Registro de un nuevo pago</b></h1>
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
                    <h3 class="card-title">Datos de los pagos</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="pagos-table" class="table table-striped table-bordered table-hover table-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col" class="text-center">Cuota</th>
                                        <th scope="col" class="text-center">Monto Cuota</th>
                                        <th scope="col" class="text-center">Fecha Pago</th>
                                        <th scope="col" class="text-center">Estado</th>
                                        <th scope="col" class="text-center">Fecha Cancelado</th>
                                        <th scope="col" class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagos as $pago)
                                        <tr>
                                            <td class="text-center font-weight-bold">
                                                {{ preg_replace('/\D/', '', $pago->referencia_pago) }}</td>
                                            <td class="text-right">$
                                                {{ number_format($pago->monto_pagado, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}</td>
                                            <td class="text-center">{{ $pago->estado }}</td>
                                            <td class="text-center">
                                                {{ $pago->fecha_cancelado ? \Carbon\Carbon::parse($pago->fecha_cancelado)->format('d/m/Y') : '' }}
                                            </td>
                                            {{-- Botones Acciones --}}
                                            @if ($pago->estado == 'Confirmado')
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Cancelado">
                                                            <i class="fas fa-times-circle"></i>
                                                        </button>
                                                        <a href="{{ route('admin.pagos.comprobantedepago', $pago->id) }}"
                                                            class="btn btn-warning btn-sm" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title="Imprimir Recibo" target="_blank">
                                                            <i class="fas fa-print"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <form action="{{ route('admin.pagos.store', $pago->id) }}"
                                                            method="POST" onclick="preguntar{{ $pago->id }}(event)"
                                                            id="miFormulario{{ $pago->id }}">
                                                            @csrf

                                                            <button type="button" class="btn btn-success btn-sm"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Pagar">
                                                                <i class="fas fa-money-bill-wave"></i>
                                                            </button>
                                                        </form>
                                                        <script>
                                                            function preguntar{{ $pago->id }}(event) {
                                                                event.preventDefault();
                                                                Swal.fire({
                                                                    title: "¿Estás seguro de registrar el pago?",
                                                                    html: `
                                                                        <p>¡No podrás revertir esto!</p>
                                                                        <label for="metodo_pago">Selecciona el método de pago:</label>
                                                                        <select id="metodo_pago" class="swal2-input" required>
                                                                            <option value="" disabled selected>Elige una opción</option>
                                                                            <option value="Efectivo">Efectivo</option>
                                                                            <option value="Transferencia">Transferencia</option>
                                                                            <option value="Tarjeta">Tarjeta</option>
                                                                            <option value="Cheque">Cheque</option>
                                                                        </select>
                                                                    `,
                                                                    icon: "warning",
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: "#3085d6",
                                                                    cancelButtonColor: "#d33",
                                                                    confirmButtonText: "¡Sí, registrar!",
                                                                    cancelButtonText: "Cancelar",
                                                                    preConfirm: () => {
                                                                        const metodoPago = document.getElementById('metodo_pago').value;
                                                                        if (!metodoPago) {
                                                                            Swal.showValidationMessage('Debes seleccionar un método de pago');
                                                                        }
                                                                        return metodoPago;
                                                                    }
                                                                }).then((result) => {
                                                                    if (result.isConfirmed && result.value) {
                                                                        const metodoPagoSeleccionado = result.value;
                                                                        console.log("Método de Pago:", metodoPagoSeleccionado); // Para verificar en la consola

                                                                        // Enviar el método de pago junto con el formulario
                                                                        const form = $('#miFormulario{{ $pago->id }}');
                                                                        $('<input>').attr({
                                                                            type: 'hidden',
                                                                            name: 'metodo_pago',
                                                                            value: metodoPagoSeleccionado
                                                                        }).appendTo(form);

                                                                        form.submit();
                                                                    }
                                                                });

                                                            }
                                                        </script>
                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = $('#pagos-table').DataTable({
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
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@stop
