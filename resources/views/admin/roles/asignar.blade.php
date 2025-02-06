@extends('adminlte::page')

@section('content_header')
    <h1><b>Asignar permisos a el rol: </b><span class="text-primary">{{ $role->name }}</span></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-primary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title my-1">Permisos registrados</h3>
                    <button type="button" class="btn btn-sm btn-success" id="toggleSelect">
                        Seleccionar todos
                    </button>
                </div>

                <div class="card-body permisos-scroll">
                    <form action="{{ route('admin.roles.update_asignar', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @foreach ($permisos as $modulo => $grupoPermisos)
                            <div class="col-md-12">
                                <h3>{{ $modulo }}</h3>
                                @foreach ($grupoPermisos as $permiso)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input permiso-checkbox" name="permisos[]"
                                            value="{{ $permiso->id }}"
                                            {{ $role->hasPermissionTo($permiso->name) ? 'checked' : '' }}>
                                        <label for="" class="form-check-label">{{ $permiso->name }}</label>
                                    </div>
                                @endforeach
                                <hr>
                            </div>
                        @endforeach

                </div>
                <hr>
                <div class="col-md-12 d-flex justify-content-between">
                    <a href="{{ route('admin.roles.index') }}"
                        class="btn btn-secondary text-white text-decoration-none mb-4 ml-4"><i class="fas fa-reply"></i>
                        Volver</a>
                    <button type="submit" class="btn btn-primary mb-4 mr-4">Guardar</button>
                </div>
                </form>


                {{-- <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($permisos as $permiso)
                                    <li>{{ $permiso->name }}</li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .permisos-scroll {
            max-height: 600px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .card-footer {
            background-color: transparent;
            text-align: right;
        }

        .card-header .btn {
            margin-left: auto;
            /* Alinea el botón a la derecha */
        }
    </style>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButton = document.getElementById('toggleSelect');
            const checkboxes = document.querySelectorAll('.permiso-checkbox');

            toggleButton.addEventListener('click', () => {
                const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);

                checkboxes.forEach(checkbox => {
                    checkbox.checked = !allChecked;
                });

                toggleButton.textContent = allChecked ? 'Seleccionar todos' : 'Deseleccionar todos';
            });
        });
    </script>
@stop
