<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contrato</title>
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
    <table border="0" style="font-size: 9pt;">
        <tr style="text-align: center;">
            <td width="200px">
                {{ $configuracion->nombre }} <br>
                {{ $configuracion->descripcion }} <br>
                {{ $configuracion->direccion }} <br>
                {{ $configuracion->telefono }} <br>
                {{ $configuracion->email }}
            </td>
            <td width="380px"></td>
            <td>
                <img src="{{ public_path('storage/' . $configuracion->logo) }}" alt="imagen" width="80px">
            </td>
        </tr>
    </table>

    <p style="text-align: center;">
        <b style="font-size: 18pt">Préstamo Nro {{ str_pad($prestamo->id, 8, '0', STR_PAD_LEFT) }}</b>
    </p>

    <br>
    <b>Datos del cliente:</b>
    <hr>

    <table border="0" class="table table-bordered" cellpadding="3" style="width: 100%;">
        <colgroup>
            <!-- Definir el ancho de las columnas -->
            <col style="width: 20%;">
            <col style="width: 30%;">
            <col style="width: 20%;">
            <col style="width: 30%;">
        </colgroup>
        <tr>
            <td style="background-color: #c0c0c0;">
                <b>Documento:</b>
            </td>
            <td>
                {{ number_format($prestamo->cliente->nro_documento, 0, ',', '.') }}
            </td>
            <td style="background-color: #c0c0c0;">
                <b>Email:</b>
            </td>
            <td>
                {{ $prestamo->cliente->email }}
            </td>
        </tr>
        <tr>
            <td style="background-color: #c0c0c0;">
                <b>Cliente:</b>
            </td>
            <td>
                {{ $prestamo->cliente->apellido . ', ' . $prestamo->cliente->nombre }}
            </td>
            <td style="background-color: #c0c0c0;">
                <b>Celular:</b>
            </td>
            <td>
                {{ $prestamo->cliente->celular }}
            </td>
        </tr>
        <tr>
            <td style="background-color: #c0c0c0;">
                <b>Fecha Nacimiento:</b>
            </td>
            <td>
                {{ \Carbon\Carbon::parse($prestamo->cliente->fecha_nacimiento)->format('d/m/Y') }}
            </td>
            <td style="background-color: #c0c0c0;">
                <b>Referencia:</b>
            </td>
            <td>
                {{ $prestamo->cliente->ref_celular }}
            </td>
        </tr>
        <tr>
            <td style="background-color: #c0c0c0;">
                <b>Género:</b>
            </td>
            <td>
                {{ $prestamo->cliente->genero }}
            </td>
            <td style="background-color: #c0c0c0;">
            </td>
            <td>
            </td>
        </tr>
    </table>

    <br>
    <b>Detalles del préstamo:</b>
    <hr>

    <table border="0" class="table table-bordered" cellpadding="3" style="width: 100%;">
        <colgroup>
            <!-- Definir el ancho de las columnas -->
            <col style="width: 20%;">
            <col style="width: 30%;">
            <col style="width: 20%;">
            <col style="width: 30%;">
        </colgroup>
        <tr>
            <td style="background-color: #c0c0c0;">
                <b>Monto del préstamo:</b>
            </td>
            <td style="text-align: right;">
                $ {{ number_format($prestamo->monto_prestado, 2, ',', '.') }}
            </td>
            <td style="background-color: #c0c0c0;">
                <b>Tasa de interés:</b>
            </td>
            <td>
                {{ $prestamo->tasa_interes }}%
            </td>
        </tr>
        <tr>
            <td style="background-color: #c0c0c0;">
                <b>Modalidad:</b>
            </td>
            <td>
                {{ $prestamo->modalidad }}
            </td>
            <td style="background-color: #c0c0c0;">
                <b>N° de cuotas:</b>
            </td>
            <td>
                {{ $prestamo->nro_cuotas }}
            </td>
        </tr>
        <tr>
            <td style="background-color: #c0c0c0;">
                <b>Monto total:</b>
            </td>
            <td style="text-align: right;">
                $ {{ number_format($prestamo->monto_total, 2, ',', '.') }}
            </td>
            <td style="background-color: #c0c0c0;">
                <b>Estado:</b>
            </td>
            <td>
                {{ $prestamo->estado }}
            </td>
        </tr>
    </table>

    <br>
    <b>Detalle de las cuotas:</b>
    <hr>

    <table border="0" class="table table-bordered" cellpadding="3" style="width: 100%;">
        <thead>
            <tr style="background-color: #c0c0c0;">
                <th>N° Cuota</th>
                <th>Fecha Pago</th>
                <th>Monto</th>
                <th>Estado</th>
            </tr>
        </thead>
        <colgroup>
            <!-- Definir el ancho de las columnas -->
            <col style="width: 20%;">
            <col style="width: 30%;">
            <col style="width: 20%;">
            <col style="width: 30%;">
        </colgroup>
        @php
            $contador = 1;
        @endphp
        @foreach ($pagos as $pago)
            <tr>
                <td style="text-align: center;">
                    {{ $contador++ }}
                </td>
                <td style="text-align: center;">
                    {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                </td>
                <td style="text-align: right;">
                    $ {{ number_format($pago->monto_pagado, 2, ',', '.') }}
                </td>
                <td style="text-align: center;">
                    {{ $pago->estado }}
                </td>
            </tr>
        @endforeach

    </table>


</body>

</html>
