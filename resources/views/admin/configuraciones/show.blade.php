@extends('adminlte::page')

@section('content_header')
    <h1><b>Detalle de la configuración</b></h1>
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
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombre">Nombre de la institución</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-home"></i></span>
                                            </div>
                                            <input type="text" name="nombre" id="nombre"
                                                value="{{ $configuracion->nombre }}" class="form-control"
                                                placeholder="Institución" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="descripcion">Descripción de la institución</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-university"></i></span>
                                            </div>
                                            <input type="text" name="descripcion"
                                                value="{{ $configuracion->descripcion }}" id="descripcion"
                                                class="form-control" placeholder="Descripción" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-map-marked"></i></span>
                                            </div>
                                            <input type="text" name="direccion" value="{{ $configuracion->direccion }}"
                                                id="direccion" class="form-control" placeholder="Dirección" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" name="telefono" value="{{ $configuracion->telefono }}"
                                                id="telefono" class="form-control" placeholder="Teléfono" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" name="email" value="{{ $configuracion->email }}"
                                                id="email" class="form-control" placeholder="Email" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="web">Página web</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                            </div>
                                            <input type="text" name="web" value="{{ $configuracion->web }}"
                                                id="web" class="form-control" placeholder="Página web" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="moneda">Moneda</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                            </div>
                                            <input type="text" name="moneda" value="{{ $configuracion->moneda }}"
                                                id="moneda" class="form-control" placeholder="Moneda" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex justify-content-center align-items-center">
                            <div class="form-group text-center">
                                <label for="logo">Logo</label><br><br>
                                <img src="{{ asset('storage/' . $configuracion->logo) }}" width="100px" alt="imagen"
                                    class="img-fluid">
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <a
                                href="{{ route('admin.configuracion.index') }}"class="btn btn-secondary text-white text-decoration-none">
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
            background-color: white !important;
            /* font-weight: bold !important; */
            color: #45b817 !important;
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
