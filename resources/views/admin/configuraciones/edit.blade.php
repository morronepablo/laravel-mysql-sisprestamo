@extends('adminlte::page')

@section('content_header')
    <h1><b>Modificación de una configuración</b></h1>
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
                    <form action="{{ route('admin.configuracion.update', $configuracion->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombre">Nombre de la institución</label> <b
                                                class="text-danger">(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                </div>
                                                <input type="text" name="nombre" id="nombre"
                                                    value="{{ old('nombre', $configuracion->nombre) }}"
                                                    class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                                    placeholder="Institución" required>
                                            </div>
                                            @error('nombre')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="descripcion">Descripción de la institución</label> <b
                                                class="text-danger">(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-university"></i></span>
                                                </div>
                                                <input type="text" name="descripcion"
                                                    value="{{ old('descripcion', $configuracion->descripcion) }}"
                                                    id="descripcion"
                                                    class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                                                    placeholder="Descripción" required>
                                            </div>
                                            @error('descripcion')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label> <b class="text-danger">(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-map-marked"></i></span>
                                                </div>
                                                <input type="text" name="direccion"
                                                    value="{{ old('direccion', $configuracion->direccion) }}" id="direccion"
                                                    class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                                                    placeholder="Dirección" required>
                                            </div>
                                            @error('direccion')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label> <b class="text-danger">(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" name="telefono"
                                                    value="{{ old('telefono', $configuracion->telefono) }}" id="telefono"
                                                    class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                    placeholder="Teléfono" required>
                                            </div>
                                            @error('telefono')
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
                                                <input type="email" name="email"
                                                    value="{{ old('email', $configuracion->email) }}" id="email"
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
                                            <label for="web">Página web</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                                </div>
                                                <input type="text" name="web"
                                                    value="{{ old('web', $configuracion->web) }}" id="web"
                                                    class="form-control {{ $errors->has('web') ? 'is-invalid' : '' }}"
                                                    placeholder="Página web">
                                            </div>
                                            @error('web')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="moneda">Moneda</label> <b class="text-danger">(*)</b>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                                </div>
                                                <select name="moneda" id="select_moneda"
                                                    value="{{ old('moneda', $configuracion->moneda) }}"
                                                    class="form-control select2 {{ $errors->has('moneda') ? 'is-invalid' : '' }}"
                                                    style="height: 50px !important;" required>
                                                    <option value="" disabled selected>Selec. moneda</option>
                                                    <option value="usd"
                                                        {{ old('moneda', $configuracion->moneda) == 'usd' ? 'selected' : '' }}>
                                                        Dólar Estadounidense (USD)</option>
                                                    <option value="eur"
                                                        {{ old('moneda', $configuracion->moneda) == 'eur' ? 'selected' : '' }}>
                                                        Euro (EUR)</option>
                                                    <option value="jpy"
                                                        {{ old('moneda', $configuracion->moneda) == 'jpy' ? 'selected' : '' }}>
                                                        Yen Japones (JPY)</option>
                                                    <option value="gbp"
                                                        {{ old('moneda', $configuracion->moneda) == 'gbp' ? 'selected' : '' }}>
                                                        Libra Esterlina (GBP)</option>
                                                    <option value="btc"
                                                        {{ old('moneda', $configuracion->moneda) == 'btc' ? 'selected' : '' }}>
                                                        Bitcoin (BTC)</option>
                                                    <option value="inr"
                                                        {{ old('moneda', $configuracion->moneda) == 'inr' ? 'selected' : '' }}>
                                                        Rupia India (INR)</option>
                                                    <option value="mxn"
                                                        {{ old('moneda', $configuracion->moneda) == 'mxn' ? 'selected' : '' }}>
                                                        Peso Mexicano (MXN)</option>
                                                    <option value="cad"
                                                        {{ old('moneda', $configuracion->moneda) == 'cad' ? 'selected' : '' }}>
                                                        Dólar Canadiense (CAD)</option>
                                                    <option value="chf"
                                                        {{ old('moneda', $configuracion->moneda) == 'chf' ? 'selected' : '' }}>
                                                        Franco Suizo (CHF)</option>
                                                    <option value="$"
                                                        {{ old('moneda', $configuracion->moneda) == '$' ? 'selected' : '' }}>
                                                        Peso Argentino (ARS)</option>
                                                    <option value="clp"
                                                        {{ old('moneda', $configuracion->moneda) == 'clp' ? 'selected' : '' }}>
                                                        Peso Chileno (CLP)</option>
                                                    <option value="pen"
                                                        {{ old('moneda', $configuracion->moneda) == 'pen' ? 'selected' : '' }}>
                                                        Sol Peruano (PEN)</option>
                                                    <option value="brl"
                                                        {{ old('moneda', $configuracion->moneda) == 'brl' ? 'selected' : '' }}>
                                                        Real Brasileño (BRL)</option>
                                                    <option value="bob"
                                                        {{ old('moneda', $configuracion->moneda) == 'bob' ? 'selected' : '' }}>
                                                        Bolivianos (BOB)</option>
                                                    <option value="aud"
                                                        {{ old('moneda', $configuracion->moneda) == 'aud' ? 'selected' : '' }}>
                                                        Dólar Australiano (AUD)</option>
                                                    <option value="cny"
                                                        {{ old('moneda', $configuracion->moneda) == 'cny' ? 'selected' : '' }}>
                                                        Yuan Chino (CNY)</option>
                                                    <option value="sek"
                                                        {{ old('moneda', $configuracion->moneda) == 'sek' ? 'selected' : '' }}>
                                                        Corona Sueca (SEK)</option>
                                                    <option value="nok"
                                                        {{ old('moneda', $configuracion->moneda) == 'nok' ? 'selected' : '' }}>
                                                        Corona Noruega (NOK)</option>
                                                    <option value="rub"
                                                        {{ old('moneda', $configuracion->moneda) == 'rub' ? 'selected' : '' }}>
                                                        Rubio Ruso (RUB)</option>
                                                </select>
                                            </div>
                                            @error('moneda')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="logo">Logo</label> <b class="text-danger">(*)</b>
                                    <input type="file" id="file" name="logo" accept=".jpg,.jpeg,.png"
                                        class="form-control {{ $errors->has('moneda') ? 'is-invalid' : '' }}">
                                    @error('logo')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <br>
                                    <center>
                                        <output id="list">
                                            <img src="{{ asset('storage/' . $configuracion->logo) }}" width="20%"
                                                alt="logo">
                                        </output>
                                    </center>
                                    <script>
                                        function archivo(evt) {
                                            var files = evt.target.files; // FileList object
                                            // Obtenemos la imagen del campo "file".
                                            for (var i = 0, f; f = files[i]; i++) {
                                                //Solo admitimos imágenes.
                                                if (!f.type.match('image.*')) {
                                                    continue;
                                                }
                                                var reader = new FileReader();
                                                reader.onload = (function(theFile) {
                                                    return function(e) {
                                                        // Insertamos la imagen
                                                        document.getElementById("list").innerHTML = ['<img class="thumb thumbnail" src="', e
                                                            .target.result, '" width="170px" title="', escape(theFile.name), '"/>'
                                                        ].join('');
                                                    };
                                                })(f);
                                                reader.readAsDataURL(f);
                                            }
                                        }
                                        document.getElementById('file').addEventListener('change', archivo, false);
                                    </script>
                                </div>
                            </div>
                        </div>
                        <p class="text-danger">(*) Campos requeridos</p>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between">
                                <a href="{{ route('admin.configuracion.index') }}"
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
            $('#select_moneda').select2({
                placeholder: "Seleccione moneda",
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
