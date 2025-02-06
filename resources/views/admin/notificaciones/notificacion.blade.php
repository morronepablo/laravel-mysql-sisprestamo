<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Notificación de Pago</h1>
    <hr>
    <br>
    <p>Usted tiene un pago atrasado, le pedimos que por favor regularice lo antes posible.</p>
    <br>
    <p>
        <b>Detalle del pago</b><br>
    </p>
    <hr>
    <p>
        <b>Monto: </b>$ {{ number_format($pago->monto_pagado, 2, ',', '.') }} <br>
        <b>Fecha de Vencimiento: </b>{{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }} <br>
        <b>{{ $pago->referencia_pago }}</b> <br>
        <b>Estado: </b>{{ $pago->estado }} <br>
    </p>

    <small>Muchas gracias por su atención.</small>

</body>

</html>
