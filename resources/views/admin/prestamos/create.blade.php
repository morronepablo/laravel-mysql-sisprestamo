@extends('adminlte::page')

@section('content_header')
    <h1><b>Registro de un nuevo préstamo</b></h1>
    <hr>
@stop

@section('content')
    <form action="{{ route('admin.prestamos.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Datos del cliente</h3>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <label for="nro_documento">Búsqueda del cliente</label> <b class="text-danger">(*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <select name="cliente_id" id="select_cliente"
                                        class="form-control select2 {{ $errors->has('cliente_id') ? 'is-invalid' : '' }}"
                                        style="height: 50px !important;" required>
                                        <option value="" disabled selected>Buscar cliente...</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}"
                                                {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                                {{ $cliente->nro_documento }} -
                                                {{ $cliente->nombre . ', ' . $cliente->apellido }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('cliente_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="" id="contenido_cliente" style="display: none;">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nro_documento">N° Documento</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            </div>
                                            <input type="text" name="nro_documento" id="nro_documento"
                                                class="form-control" placeholder="N° Documento" disabled>
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
                                            <input type="text" name="nombre" id="nombre" class="form-control"
                                                placeholder="Nombres cliente" disabled>
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
                                            <input type="text" name="apellido" id="apellido" class="form-control"
                                                placeholder="Apellidos cliente" disabled>
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
                                                class="form-control" placeholder="Fecha nacimiento" disabled>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fecha_nacimiento">Género</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                            </div>
                                            <input type="text" name="genero" id="genero" class="form-control"
                                                placeholder="Genero" disabled>
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
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="Email" disabled>
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
                                            <input type="celular" name="celular" id="celular" class="form-control"
                                                placeholder="Celular" disabled>
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
                                            <input type="ref_celular" name="ref_celular" id="ref_celular"
                                                class="form-control" placeholder="Referencia" disabled>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Datos del préstamo</h3>
                    </div>
                    <div class="card-body">

                        {{-- Datos del préstamo --}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="monto_prestado">Monto del préstamo</label>
                                    <input type="text" id="monto_prestado" value="{{ old('monto_prestado') }}"
                                        class="form-control text-right {{ $errors->has('monto_prestado') ? 'is-invalid' : '' }}">
                                    <input type="text" name="monto_prestado" value="{{ old('monto_prestado') }}"
                                        id="monto_prestado2" hidden>
                                </div>
                                @error('monto_prestado')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <div class="input-group mb-3">
                                    <label for="tasa_interes">Tasa de interés</label>
                                    <input type="text" name="tasa_interes" id="tasa_interes"
                                        value="{{ old('tasa_interes') }}"
                                        class="form-control
                                        {{ $errors->has('tasa_interes') ? 'is-invalid' : '' }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                @error('tasa_interes')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="modalidad">Modalidad</label>
                                    <select name="modalidad" id="select_modalidad" value="{{ old('modalidad') }}"
                                        class="form-control select2 {{ $errors->has('modalidad') ? 'is-invalid' : '' }}"
                                        style="height: 50px !important;" required>
                                        <option value="" disabled selected>Selec. modalidad</option>
                                        <option value="Diario">Diario</option>
                                        <option value="Semanal">Semanal</option>
                                        <option value="Quincenal">Quincenal</option>
                                        <option value="Mensual" selected>Mensual</option>
                                        <option value="Anual">Anual</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label for="nro_cuotas">Cuotas</label>
                                    <input type="number" name="nro_cuotas" id="nro_cuotas"
                                        value="{{ old('nro_cuotas') }}"
                                        class="form-control {{ $errors->has('nro_cuotas') ? 'is-invalid' : '' }}"">
                                </div>
                                @error('nro_cuotas')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha préstamo</label>
                                    <input type="date" name="fecha_inicio" id="fecha_inicio"
                                        value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div style="height: 33px;"></div>
                                    <button type="button" onclick="calcularPrestamo()" class="btn btn-success"><i
                                            class="fas fa-calculator"></i> Calcular
                                        Préstamo</button>
                                </div>
                            </div>
                        </div>

                        <hr>

                        {{-- Resultados cálculos préstamo --}}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Monto por cuota</label>
                                    <input type="text" id="monto_cuota" name="monto_cuota"
                                        class="form-control text-right" disabled>
                                    <input type="text" id="monto_cuota2" name="monto_cuota"
                                        class="form-control text-right" hidden>
                                </div>
                                @error('monto_total')
                                    <small class="text-danger">Por favor, realice el cálculo del préstamo</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Monto del interés</label>
                                    <input type="text" id="monto_interes" class="form-control text-right" disabled>
                                </div>
                                @error('monto_total')
                                    <small class="text-danger">Por favor, realice el cálculo del préstamo</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Monto Final</label>
                                    <input type="text" id="monto_final" class="form-control text-right" disabled>
                                    <input type="text" id="monto_final2" name="monto_total" hidden>
                                </div>
                                @error('monto_total')
                                    <small class="text-danger">Por favor, realice el cálculo del préstamo</small>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        {{-- Botones para registrar --}}
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-between">
                                <a href="{{ route('admin.prestamos.index') }}"
                                    class="btn btn-secondary text-white text-decoration-none"><i class="fas fa-reply"></i>
                                    Volver</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-regular fa-floppy-disk"></i> Registrar
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </form>

@stop

@section('adminlte_css')
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#select_cliente').select2({
                placeholder: "Buscar cliente...",
                allowClear: false
            });

            $('#select_modalidad').select2({
                placeholder: "Modalidad",
                allowClear: false
            });

            // Función para formatear el monto
            function formatearMonto(monto) {
                // Forzar dos decimales en el formato
                return `$ ${parseFloat(monto).toLocaleString('es-ES', {
            minimumFractionDigits: 2, // Siempre mostrar dos decimales
            maximumFractionDigits: 2
        })}`;
            }

            // Función para quitar el formato
            function quitarFormato(montoFormateado) {
                // Convertir el valor formateado a un número sin formato
                let montoSinFormato = montoFormateado
                    .replace(/[^0-9.,]/g, '') // Eliminar símbolos no numéricos (excepto punto y coma)
                    .replace(/\./g, '') // Eliminar separadores de miles (puntos)
                    .replace(',', '.'); // Convertir coma decimal a punto

                // Si el número no tiene decimales, eliminar los ".00"
                if (montoSinFormato.endsWith('.00')) {
                    montoSinFormato = montoSinFormato.replace('.00', '');
                }

                return montoSinFormato;
            }

            // Evento input para validar en tiempo real
            $('#monto_prestado').on('input', function() {
                // Eliminar caracteres no numéricos (excepto el punto decimal)
                let valor = $(this).val().replace(/[^0-9.]/g, '');
                $(this).val(valor); // Actualizar el valor del input
            });

            // Evento blur para formatear el monto cuando el input pierde el foco
            $('#monto_prestado').on('blur', function() {
                let monto = $(this).val();
                if (monto) {
                    let montoFormateado = formatearMonto(monto);
                    $(this).val(montoFormateado); // Mostrar el valor formateado
                }
                $('#monto_prestado2').val(monto)
            });

            // Evento focus para quitar el formato cuando el input recibe el foco
            $('#monto_prestado').on('focus', function() {
                let montoFormateado = $(this).val();
                let montoSinFormato = quitarFormato(montoFormateado); // Quitar el formato
                $(this).val(montoSinFormato); // Mostrar el valor sin formato
            });

            $('#select_cliente').on('change', function() {
                var id = $(this).val();
                if (id) {
                    $.ajax({
                        url: "{{ url('/admin/prestamos/cliente/') }}" + '/' + id,
                        type: 'GET',
                        success: function(cliente) {
                            $('#contenido_cliente').css('display', 'block')
                            $('#nro_documento').val(cliente.nro_documento);
                            $('#nombre').val(cliente.nombre);
                            $('#apellido').val(cliente.apellido);
                            $('#fecha_nacimiento').val(cliente.fecha_nacimiento);
                            $('#genero').val(cliente.genero);
                            $('#email').val(cliente.email);
                            $('#celular').val(cliente.celular);
                            $('#ref_celular').val(cliente.ref_celular);
                        },
                        error: function() {
                            alert('Error al cargar cliente');
                        }
                    });
                }
            });
        });

        function calcularPrestamo() {
            // Obtener y limpiar los valores del formulario
            const montoPrestado = parseFloat(
                document.getElementById('monto_prestado').value.replace(/[^0-9,]/g, '')
            );
            const tasaInteres = parseFloat(
                document.getElementById('tasa_interes').value.replace(/[^0-9.]/g, '')
            ) / 100;
            const modalidad = document.getElementById('select_modalidad').value;
            const nroCuotas = parseInt(
                document.getElementById('nro_cuotas').value.replace(/[^0-9]/g, '')
            );


            // Validar los valores
            if (isNaN(montoPrestado) || isNaN(tasaInteres) || isNaN(nroCuotas) || montoPrestado <= 0 ||
                tasaInteres < 0 || nroCuotas <= 0) {
                alert('Por favor ingrese valores válidos');
                return;
            }

            // Ajustar la tasa de interés según la modalidad
            let tasaInteresAjustada = 0;

            switch (modalidad) {
                case "Diario":
                    tasaInteresAjustada = tasaInteres / 30; // Tasa diaria
                    break;
                case "Semanal":
                    tasaInteresAjustada = tasaInteres / 4; // Tasa semanal
                    break;
                case "Quincenal":
                    tasaInteresAjustada = tasaInteres / 2; // Tasa quincenal
                    break;
                case "Mensual":
                    tasaInteresAjustada = tasaInteres; // Tasa mensual
                    break;
                case "Anual":
                    tasaInteresAjustada = tasaInteres / 12; // Tasa mensual (anual dividido por 12)
                    break;
                default:
                    alert('Modalidad no válida');
                    return;
            }

            // Calculo del interés total
            const interesTotal = montoPrestado * tasaInteresAjustada * nroCuotas;

            // Calculo del total a pagar
            const totalCancelar = montoPrestado + interesTotal;

            // Calculo de la cuota fija
            const cuotaFija = totalCancelar / nroCuotas;

            // Formatear los resultados
            const cuotaFormateada =
                `$ ${cuotaFija.toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
            const interesTotalFormateada =
                `$ ${interesTotal.toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
            const totalCancelarFormateada =
                `$ ${totalCancelar.toLocaleString('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;

            // Mostrar los resultados en los inputs
            $('#monto_prestado2').val(montoPrestado);
            $('#monto_cuota').val(cuotaFormateada);
            $('#monto_cuota2').val(cuotaFija);
            $('#monto_interes').val(interesTotalFormateada);
            $('#monto_final').val(totalCancelarFormateada);
            $('#monto_final2').val(totalCancelar.toFixed(2));
        }
    </script>

    @stack('js')
    @yield('js')
@stop

@section('css')

@stop

@section('js')

@stop
