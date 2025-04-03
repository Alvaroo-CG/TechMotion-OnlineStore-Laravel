<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmación de Pedido</title>
</head>
<body>
    <h2>Nuevo Pedido Recibido</h2>
    <p>Has recibido un nuevo pedido de {{ $order->user->name }}.</p>
    <p>Número de Pedido: {{ $order->id }}</p>
    <p>Total: ${{ number_format($order->total, 2) }}</p>
    <p>Correo del Cliente: {{ $order->user->email }}</p>
</body>
</html>