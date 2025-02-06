@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Pagos</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title my-1">Pagos registrados</h3>
                </div>

                <div class="card-body">
                    <table id="pagos-table" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">Nro.</th>
                                <th scope="col" class="text-center">Documento</th>
                                <th scope="col" class="text-center">Nombre y Apellido</th>
                                <th scope="col" class="text-center">Cuota Pagada</th>
                                <th scope="col" class="text-center">N° Cuotas</th>
                                <th scope="col" class="text-center">Fecha Cancelación</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($pagos as $pago)
                                <tr>
                                    <th scope="row" class="text-center">{{ $contador++ }}</th>
                                    <td class="text-center">
                                        {{ number_format($pago->prestamo->cliente->nro_documento, 0, ',', '.') }}</td>
                                    <td>{{ $pago->prestamo->cliente->nombre . ', ' . $pago->prestamo->cliente->apellido }}
                                    </td>
                                    <td class="text-right">$ {{ number_format($pago->monto_pagado, 2, ',', '.') }}</td>
                                    <td>{{ $pago->referencia_pago }}</td>
                                    <td class="text-center">
                                        {{ $pago->fecha_cancelado ? \Carbon\Carbon::parse($pago->fecha_cancelado)->format('d/m/Y') : '' }}
                                    </td>
                                    {{-- Botones Acciones --}}
                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            @can('admin.pagos.show')
                                                <a href="{{ route('admin.pagos.show', $pago->id) }}" class="btn btn-info btn-sm"
                                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Pago">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endcan

                                            @can('admin.pagos.comprobantedepago')
                                                <a href="{{ route('admin.pagos.comprobantedepago', $pago->id) }}"
                                                    class="btn btn-warning btn-sm text-white" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Imprimir Pago" target="_blank">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                            @endcan

                                            @can('admin.pagos.destroy')
                                                <form action="{{ route('admin.pagos.destroy', $pago->id) }}" method="POST"
                                                    onclick="preguntar{{ $pago->id }}(event)"
                                                    id="miFormulario{{ $pago->id }}">
                                                    @csrf

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Pago"
                                                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                <script>
                                                    function preguntar{{ $pago->id }}(event) {
                                                        event.preventDefault();
                                                        Swal.fire({
                                                            title: "Estas seguro?",
                                                            text: "¡No podrás revertir esto!",
                                                            icon: "warning",
                                                            showCancelButton: true,
                                                            confirmButtonColor: "#3085d6",
                                                            cancelButtonColor: "#d33",
                                                            confirmButtonText: "¡Sí, bórralo!"
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                var form = $('#miFormulario{{ $pago->id }}');
                                                                form.submit();
                                                            }
                                                        });
                                                    }
                                                </script>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @can('admin.pagos.cargar_prestamo_cliente')
            <div class="col-md-4">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title my-1">Búsqueda del cliente para pagos por préstamo</h3>
                    </div>

                    <div class="card-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <select name="cliente_id" id="select_cliente2"
                                class="form-control select2 {{ $errors->has('cliente_id') ? 'is-invalid' : '' }}"
                                style="height: 50px !important;" required>
                                <option value="" disabled selected>Buscar cliente...</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">
                                        {{ $cliente->nro_documento }} -
                                        {{ $cliente->nombre . ', ' . $cliente->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

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
        #pagos-table_wrapper .dt-buttons {
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
            table.buttons().container().appendTo('#pagos-table_wrapper .col-md-12:eq(1)');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#select_cliente2').select2({
                placeholder: "Seleccione cliente",
                allowClear: false
            });
            $('#select_cliente2').on('change', function() {
                var id = $(this).val();
                if (id) {
                    window.location.href = "{{ url('/admin/pagos/prestamos/cliente/') }}" + '/' + id;
                }
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


    @stack('js')
    @yield('js')
@stop
