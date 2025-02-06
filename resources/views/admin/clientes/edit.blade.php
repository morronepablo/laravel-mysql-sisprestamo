@extends('adminlte::page')

@section('content_header')
    <h1><b>Modificación de un cliente</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.clientes.update', $cliente->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nro_documento">N° Documento</label> <b class="text-danger">(*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" name="nro_documento" id="nro_documento"
                                            value="{{ old('nro_documento', $cliente->nro_documento) }}"
                                            class="form-control {{ $errors->has('nro_documento') ? 'is-invalid' : '' }}"
                                            placeholder="N° Documento" required>
                                    </div>
                                    @error('nro_documento')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nombre">Nombres cliente</label> <b class="text-danger">(*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="nombre" id="nombre"
                                            value="{{ old('nombre', $cliente->nombre) }}"
                                            class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                            placeholder="Nombres cliente" required>
                                    </div>
                                    @error('nombre')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apellido">Apellidos cliente</label> <b class="text-danger">(*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" name="apellido" id="apellido"
                                            value="{{ old('apellido', $cliente->apellido) }}"
                                            class="form-control {{ $errors->has('apellido') ? 'is-invalid' : '' }}"
                                            placeholder="Apellidos cliente" required>
                                    </div>
                                    @error('apellido')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha nacimiento</label> <b class="text-danger">(*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                            value="{{ old('fecha_nacimiento', $cliente->fecha_nacimiento) }}"
                                            class="form-control {{ $errors->has('fecha_nacimiento') ? 'is-invalid' : '' }}"
                                            placeholder="Fecha nacimiento" required>
                                    </div>
                                    @error('fecha_nacimiento')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Género</label> <b class="text-danger">(*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                        </div>
                                        <select name="genero" id="select_genero" value="{{ old('genero') }}"
                                            class="form-control select2 {{ $errors->has('genero') ? 'is-invalid' : '' }}"
                                            style="height: 50px !important;" required>
                                            <option value="" disabled selected>Selec. genero</option>
                                            <option value="Masculino"
                                                {{ old('genero', $cliente->genero) == 'Masculino' ? 'selected' : '' }}>
                                                Masculino</option>
                                            <option value="Femenino"
                                                {{ old('genero', $cliente->genero) == 'Femenino' ? 'selected' : '' }}>
                                                Femenino</option>
                                            {{-- <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option> --}}
                                        </select>
                                    </div>
                                    @error('genero')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="email">Email</label> <b class="text-danger">(*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="email" value="{{ old('email', $cliente->email) }}"
                                            id="email"
                                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            placeholder="Email" required>
                                    </div>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="celular">Celular</label> <b class="text-danger">(*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="celular" name="celular"
                                            value="{{ old('celular', $cliente->celular) }}" id="celular"
                                            class="form-control {{ $errors->has('celular') ? 'is-invalid' : '' }}"
                                            placeholder="Celular" required>
                                    </div>
                                    @error('celular')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ref_celular">Referencia</label> <b class="text-danger">(*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="ref_celular" name="ref_celular"
                                            value="{{ old('ref_celular', $cliente->ref_celular) }}" id="ref_celular"
                                            class="form-control {{ $errors->has('ref_celular') ? 'is-invalid' : '' }}"
                                            placeholder="Referencia" required>
                                    </div>
                                    @error('ref_celular')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <p class="text-danger">(*) Campos requeridos</p>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between">
                                <a href="{{ route('admin.clientes.index') }}"
                                    class="btn btn-secondary text-white text-decoration-none"><i class="fas fa-reply"></i>
                                    Volver</a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa-regular fa-floppy-disk"></i> Actualizar
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
            $('#select_genero').select2({
                placeholder: "Seleccione genero",
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
