@extends('adminlte::page')

@section('content_header')
    <h1><b>Registro de un nuevo pago</b></h1>
    <hr>
@stop

@section('content')


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
                                            {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}
                                            {{ $datosCliente->id == $cliente->id ? 'selected' : '' }}>
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

                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Datos del cliente</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <i class="fas fa-id-card"></i> {{ $datosCliente->nro_documento }} <br><br>
                                <i class="fas fa-user"></i>
                                {{ $datosCliente->apellido . ', ' . $datosCliente->nombre }} <br><br>
                                <i class="fas fa-calendar"></i> {{ $datosCliente->fecha_nacimiento }}
                                <br><br>
                                <i class="fas fa-user-check"></i> {{ $datosCliente->genero }} <br><br>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <i class="fas fa-envelope"></i> {{ $datosCliente->email }} <br><br>
                                <i class="fas fa-phone"></i> {{ $datosCliente->celular }} <br><br>
                                <i class="fas fa-phone"></i> {{ $datosCliente->ref_celular }} <br><br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Datos del préstamo</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <b>Monto prestado</b> <br>
                            <i class="fas fa-hand-holding-usd"></i> $
                            {{ number_format($prestamo->monto_prestado, 2, ',', '.') }}
                            <br><br>

                            <b>Tasa de interés</b> <br>
                            <i class="fas fa-percent"></i> {{ $prestamo->tasa_interes }}
                            <br><br>

                            <b>Modalidad</b> <br>
                            <i class="fas fa-calendar-alt"></i> {{ $prestamo->modalidad }}
                            <br><br>
                        </p>
                    </div>

                    <div class="col-md-6">
                        <p>
                            <b>N° de cuotas</b> <br>
                            <i class="fas fa-list-ol"></i> {{ $prestamo->nro_cuotas }}<br><br>

                            <b>Monto total</b> <br>
                            <i class="fas fa-money-bill-wave"></i> $
                            {{ number_format($prestamo->monto_total, 2, ',', '.') }}
                            <br><br>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

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
                    window.location.href = "{{ url('/admin/pagos/create/') }}" + '/' + id;
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
