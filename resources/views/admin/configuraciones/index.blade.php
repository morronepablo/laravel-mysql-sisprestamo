@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de Configuraciones</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title my-1">Configuraciones registradas</h3>
                    <div class="card-tools">
                        @can('admin.configuracion.create')
                            <a href="{{ route('admin.configuracion.create') }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-plus"></i>
                                Crear nuevo</a>
                        @endcan
                    </div>
                </div>

                <div class="card-body">
                    <table id="configuraciones-table" class="table table-striped table-bordered table-hover table-sm">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">Nro.</th>
                                <th scope="col" class="text-center">Nombre</th>
                                <th scope="col" class="text-center">Descripción</th>
                                <th scope="col" class="text-center">Dirección</th>
                                <th scope="col" class="text-center">Teléfono</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Web</th>
                                <th scope="col" class="text-center">Moneda</th>
                                <th scope="col" class="text-center">Logo</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $contador = 1; ?>
                            @foreach ($configuraciones as $configuracion)
                                <tr>
                                    <th scope="row" class="text-center">{{ $contador++ }}</th>
                                    <td>{{ $configuracion->nombre }}</td>
                                    <td>{{ $configuracion->descripcion }}</td>
                                    <td>{{ $configuracion->direccion }}</td>
                                    <td>{{ $configuracion->telefono }}</td>
                                    <td>{{ $configuracion->email }}</td>
                                    <td>{{ $configuracion->web }}</td>
                                    <td class="text-center">{{ $configuracion->moneda }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $configuracion->logo) }}" width="100"
                                            height="20" alt="imagen"
                                            style="object-fit: contain; object-position: center; width: 100px; height: 20px;">
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            @can('admin.configuracion.show')
                                                <a href="{{ route('admin.configuracion.show', $configuracion->id) }}"
                                                    class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Ver configuración">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('admin.configuracion.edit')
                                                <a href="{{ route('admin.configuracion.edit', $configuracion->id) }}"
                                                    class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Editar configuración">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            @endcan
                                            @can('admin.configuracion.destroy')
                                                <form action="{{ route('admin.configuracion.destroy', $configuracion->id) }}"
                                                    method="POST" onclick="preguntar{{ $configuracion->id }}(event)"
                                                    id="miFormulario{{ $configuracion->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Eliminar configuración"
                                                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                <script>
                                                    function preguntar{{ $configuracion->id }}(event) {
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
                                                                var form = $('#miFormulario{{ $configuracion->id }}');
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
    </div>
@stop

@section('css')
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
        #configuraciones-table_wrapper .dt-buttons {
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
@stop

@section('js')
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
            let table = $('#configuraciones-table').DataTable({
                "pageLength": 5,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ configuraciones",
                    "infoEmpty": "Mostrando 0 a 0 de 0 configuraciones",
                    "infoFiltered": "(Filtrado de _MAX_ total configuraciones)",
                    "lengthMenu": "Mostrar _MENU_ configuraciones",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron configuraciones",
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
            table.buttons().container().appendTo('#configuraciones-table_wrapper .col-md-12:eq(1)');
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
