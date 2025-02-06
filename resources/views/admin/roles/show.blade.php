@extends('adminlte::page')

@section('content_header')
    <h1><b>Detalle del rol</b></h1>
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
                                        <label for="name">Nombre del rol</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                            </div>
                                            <input type="text" name="name" id="name" value="{{ $role->name }}"
                                                class="form-control" placeholder="Nombre rol" disabled>
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
                                href="{{ route('admin.roles.index') }}"class="btn btn-secondary text-white text-decoration-none">
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

        .input-group-text {
            background-color: black !important;
            color: white !important;
            border: none !important;
        }
    </style>
@stop

@section('js')

@stop
