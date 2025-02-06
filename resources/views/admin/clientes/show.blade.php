@extends('adminlte::page')

@section('content_header')
    <h1><b>Detalle del cliente</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nro_documento">N° Documento</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="text" name="nro_documento" id="nro_documento"
                                        value="{{ $cliente->nro_documento }}" class="form-control"
                                        placeholder="N° Documento" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nombre">Nombres cliente</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="nombre" id="nombre" value="{{ $cliente->nombre }}"
                                        class="form-control" placeholder="Nombres cliente" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apellido">Apellidos cliente</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="apellido" id="apellido" value="{{ $cliente->apellido }}"
                                        class="form-control" placeholder="Apellidos cliente" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="fecha_nacimiento">Fecha nacimiento</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                        value="{{ $cliente->fecha_nacimiento }}" class="form-control"
                                        placeholder="Fecha nacimiento" disabled>
                                </div>
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
                                    <select name="genero" id="select_genero" class="form-control border-info bg-white"
                                        disabled>
                                        <option value="{{ $cliente->genero }}">
                                            {{ $cliente->genero }}</option>
                                    </select>
                                </div>
                                @error('genero')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" value="{{ $cliente->email }}" id="email"
                                        class="form-control" placeholder="Email" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="celular" name="celular" value="{{ $cliente->celular }}" id="celular"
                                        class="form-control" placeholder="Celular" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="ref_celular">Referencia</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="ref_celular" name="ref_celular" value="{{ $cliente->ref_celular }}"
                                        id="ref_celular" class="form-control" placeholder="Referencia" disabled>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <a
                                href="{{ route('admin.clientes.index') }}"class="btn btn-secondary text-white text-decoration-none">
                                <i class="fas fa-reply"></i> Volver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        input:disabled {
            background-color: rgb(219, 248, 191) !important;
            color: #277608 !important;
        }

        select:disabled {
            background-color: rgb(219, 248, 191) !important;
            color: #277608 !important;
        }

        .input-group-text {
            background-color: black !important;
            color: white !important;
            border: none !important;
        }
    </style>
@stop

@section('js')

@stop
