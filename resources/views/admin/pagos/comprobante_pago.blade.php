<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante de pago</title>
    <style>
        body {
            font-family: Arial, Arial, Helvetica, sans-serif;
            /* font-size: 10pt;
            color: #333; */
        }

        .table {
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1 px solid #000000;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000000;
        }

        .table-bordered thead th {
            border-bottom-width: 2px;
        }
    </style>
</head>

<body>

    <table border="0" style="font-size: 8pt;">
        <tr style="text-align: center;">
            <td width="200px">
                <img src="{{ public_path('storage/' . $configuracion->logo) }}" alt="imagen" width="50px"> <br>
                {{ $configuracion->nombre }} <br>
                {{ $configuracion->descripcion }} <br>
                {{ $configuracion->direccion }} <br>
            </td>
            <td width="300px"></td>
            <td width="160px">
                <b>Comprobante N°</b> {{ str_pad($pago->id, 8, '0', STR_PAD_LEFT) }} <br>
                <b>ORIGINAL</b>
            </td>
        </tr>
    </table>

    <p style="text-align: center;">
        <b style="font-size: 18pt">Comprobante de Pago</b>
    </p>

    <b>Datos del cliente:</b>
    <hr>

    <table class="table" cellpadding="2" style="width: 100%;">
        <tr>
            <!-- Columna Fecha (50%) -->
            <td style="width: 50%;"><b>Fecha: </b> {{ $fecha_literal }}</td>
            <!-- Columna Documento (50%) -->
            <td style="width: 50%;"><b>Documento: </b>
                {{ number_format($cliente->nro_documento, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="2"><b>Señor(es):</b>
                {{ $cliente->apellido . ', ' . $cliente->nombre }}</td>
        </tr>
    </table>

    <hr>
    <b>Datos del pago:</b>
    <hr>

    <table class="table table-bordered" cellpadding="2" style="width: 100%; border-collapse: collapse;">
        <colgroup>
            <col style="width: 15%;"> <!-- Ancho menor para "Nro" -->
            <col style="width: 65%;"> <!-- Mayor espacio para "Detalle" -->
            <col style="width: 20%;"> <!-- Espacio moderado para "Monto Pagado" -->
        </colgroup>
        <thead>
            <tr>
                <th style="background-color: #c0c0c0; text-align: center;">Nro</th>
                <th style="background-color: #c0c0c0; text-align: center;">Detalle</th>
                <th style="background-color: #c0c0c0; text-align: center;">Monto Pagado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;">1</td>
                <td>
                    <span style="margin: 0;">
                        <b>Pago del préstamo Nro:</b> {{ str_pad($prestamo->id, 8, '0', STR_PAD_LEFT) }} <br>
                        <b>Método de pago:</b> {{ $pago->metodo_pago }} <br>
                        <b>Pago de la cuota:</b>
                        @php
                            // Extraer solo el número de la cuota
                            $numeroCuota = preg_replace('/[^0-9]/', '', $pago->referencia_pago);
                        @endphp
                        {{ $numeroCuota }}
                    </span>
                </td>
                <td style="text-align: center;">
                    {{ $configuracion->moneda }} {{ number_format($pago->monto_pagado, 2, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <table style="text-align: center" class="table">
        <tr>
            <td><b>________________________________ <br> {{ $configuracion->nombre }}</b> <br> Usuario</td>
            <td><b>________________________________ <br> Cliente <br></b>
                {{ $cliente->apellido . ', ' . $cliente->nombre }}</td>
        </tr>
    </table>

    ---------------------------------------------------------------------------------------------------------------------------------------

    <table border="0" style="font-size: 8pt;">
        <tr style="text-align: center;">
            <td width="200px">
                <img src="{{ public_path('storage/' . $configuracion->logo) }}" alt="imagen" width="50px"> <br>
                {{ $configuracion->nombre }} <br>
                {{ $configuracion->descripcion }} <br>
                {{ $configuracion->direccion }} <br>
            </td>
            <td width="300px"></td>
            <td width="160px">
                <b>Comprobante N°</b> {{ str_pad($pago->id, 8, '0', STR_PAD_LEFT) }} <br>
                <b>DUPLICADO</b>
            </td>
        </tr>
    </table>

    <p style="text-align: center;">
        <b style="font-size: 18pt">Comprobante de Pago</b>
    </p>

    <b>Datos del cliente:</b>
    <hr>

    <table class="table" cellpadding="2" style="width: 100%;">
        <tr>
            <!-- Columna Fecha (50%) -->
            <td style="width: 50%;"><b>Fecha: </b> {{ $fecha_literal }}</td>
            <!-- Columna Documento (50%) -->
            <td style="width: 50%;"><b>Documento: </b>
                {{ number_format($cliente->nro_documento, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="2"><b>Señor(es):</b>
                {{ $cliente->apellido . ', ' . $cliente->nombre }}</td>
        </tr>
    </table>

    <hr>
    <b>Datos del pago:</b>
    <hr>

    <table class="table table-bordered" cellpadding="2" style="width: 100%; border-collapse: collapse;">
        <colgroup>
            <col style="width: 15%;"> <!-- Ancho menor para "Nro" -->
            <col style="width: 65%;"> <!-- Mayor espacio para "Detalle" -->
            <col style="width: 20%;"> <!-- Espacio moderado para "Monto Pagado" -->
        </colgroup>
        <thead>
            <tr>
                <th style="background-color: #c0c0c0; text-align: center;">Nro</th>
                <th style="background-color: #c0c0c0; text-align: center;">Detalle</th>
                <th style="background-color: #c0c0c0; text-align: center;">Monto Pagado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;">1</td>
                <td>
                    <span style="margin: 0;">
                        <b>Pago del préstamo Nro:</b> {{ str_pad($prestamo->id, 8, '0', STR_PAD_LEFT) }} <br>
                        <b>Método de pago:</b> {{ $pago->metodo_pago }} <br>
                        <b>Pago de la cuota:</b>
                        @php
                            // Extraer solo el número de la cuota
                            $numeroCuota = preg_replace('/[^0-9]/', '', $pago->referencia_pago);
                        @endphp
                        {{ $numeroCuota }}
                    </span>
                </td>
                <td style="text-align: center;">
                    {{ $configuracion->moneda }} {{ number_format($pago->monto_pagado, 2, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <table style="text-align: center" class="table">
        <tr>
            <td><b>________________________________ <br> {{ $configuracion->nombre }}</b> <br> Usuario</td>
            <td><b>________________________________ <br> Cliente <br></b>
                {{ $cliente->apellido . ', ' . $cliente->nombre }}</td>
        </tr>
    </table>

</body>

</html>
