<?php
// Endpoint base para recibir notificaciones de Mercado Pago.
// En producción, este endpoint debe validar y consultar el pago
// antes de marcar un pedido como aprobado.
//
// IMPORTANTE: no confirmes una venta solamente porque el usuario
// volvió a exito.php.

$body = file_get_contents("php://input");
$data = json_decode($body, true);

// Guardado simple para desarrollo.
// En producción reemplazalo por una actualización de tu base de datos.
file_put_contents(
    __DIR__ . "/webhook.log",
    date("Y-m-d H:i:s") . " " . $body . PHP_EOL,
    FILE_APPEND
);

http_response_code(200);
echo "OK";
