@extends('adminlte::page')

@section('content_header')
    <h1><b>Modificación de un usuario</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="role">Rol</label> <b class="text-danger">(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                                </div>
                                                @if ($usuario->name === 'Administrador')
                                                    <select name="role" id="select_role"
                                                        class="form-control select2 {{ $errors->has('role') ? 'is-invalid' : '' }}"
                                                        style="height: 50px !important;" disabled>
                                                        <option value="" disabled>Seleccione un rol</option>
                                                        <!-- Opción vacía para el placeholder -->
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->name }}"
                                                                {{ $usuario->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('role')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                @else
                                                    <select name="role" id="select_role"
                                                        class="form-control select2 {{ $errors->has('role') ? 'is-invalid' : '' }}"
                                                        style="height: 50px !important;" required>
                                                        <option value="" disabled>Seleccione un rol</option>
                                                        <!-- Opción vacía para el placeholder -->
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->name }}"
                                                                {{ $usuario->roles->pluck('name')->contains($role->name) ? 'selected' : '' }}>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('role')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                @endif
                                            </div>
                                            @error('role')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nombre usuario</label> <b class="text-danger">(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                @if ($usuario->name === 'Administrador')
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                        value="{{ old('name', $usuario->name) }}" name="name" disabled>
                                                @else
                                                    <input type="text"
                                                        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                        value="{{ old('name', $usuario->name) }}" name="name" required>
                                                @endif
                                            </div>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email</label> <b class="text-danger">(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email"
                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                    value="{{ old('email', $usuario->email) }}" name="email" required>
                                            </div>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password">Contraseña</label> <b class="text-danger">(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                </div>
                                                <input type="password" name="password" value="{{ old('password') }}"
                                                    id="password"
                                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                    placeholder="Contraseña">
                                            </div>
                                            @error('password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="password_confirmation">Repetir Contraseña</label> <b
                                                class="text-danger">(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                </div>
                                                <input type="password" name="password_confirmation"
                                                    value="{{ old('password_confirmation') }}" id="password_confirmation"
                                                    class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                                    placeholder="Repetir Contraseña">
                                            </div>
                                            @error('password_confirmation')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-danger">(*) Campos requeridos</p>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between">
                                <a href="{{ route('admin.usuarios.index') }}"
                                    class="btn btn-secondary text-white text-decoration-none"><i class="fas fa-reply"></i>
                                    Volver</a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-regular fa-floppy-disk"></i> Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@stop


@section('adminlte_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#select_role').select2({
                placeholder: "Seleccione rol",
                allowClear: false
            });
        });
    </script>

    @stack('js')
    @yield('js')
@stop


@section('css')

@stop

@section('js')

@stop
