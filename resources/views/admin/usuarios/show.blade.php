@extends('adminlte::page')

@section('content_header')
    <h1><b>Detalle del usuario</b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="role">Rol</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                            </div>
                                            <select name="role" id="select_role"
                                                class="form-control border-info bg-white" disabled>
                                                <option value="{{ $usuario->roles->pluck('name')->implode(', ') }}">
                                                    {{ $usuario->roles->pluck('name')->implode(', ') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nombre usuario</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" name="name" id="name" value="{{ $usuario->name }}"
                                                class="form-control" placeholder="Nombre usuario" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" name="email" value="{{ $usuario->email }}"
                                                id="email" class="form-control" placeholder="Email" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-end">
                            <a
                                href="{{ route('admin.usuarios.index') }}"class="btn btn-secondary text-white text-decoration-none">
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
