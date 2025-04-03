<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmación de Pedido</title>
</head>
<body>
    <h2>Confirmación de Pedido</h2>
    <p>Gracias por tu pedido, {{ $order->user->name }}. Tu pedido ha sido realizado con éxito.</p>
    <p>Número de Pedido: {{ $order->id }}</p>
    <p>Total: ${{ number_format($order->total, 2) }}</p>
</body>
</html>
