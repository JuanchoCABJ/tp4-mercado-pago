<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';

use MercadoPago\Webhook\WebhookSignatureValidator;
use MercadoPago\Exceptions\InvalidWebhookSignatureException;

/*
 * Mercado Pago envía los Webhooks por HTTP POST.
 * La documentación recomienda validar x-signature antes de procesar el evento.
 */

$secret = configWebhookSecret();

if ($secret !== '') {
    $xSignature = $_SERVER['HTTP_X_SIGNATURE'] ?? '';
    $xRequestId = $_SERVER['HTTP_X_REQUEST_ID'] ?? '';
    $dataId = $_GET['data_id'] ?? '';

    try {
        WebhookSignatureValidator::validate(
            $xSignature,
            $xRequestId,
            $dataId,
            $secret
        );
    } catch (InvalidWebhookSignatureException $e) {
        http_response_code(401);
        echo 'Firma inválida';
        exit;
    }
}

$rawBody = file_get_contents('php://input');
$data = json_decode($rawBody ?: '{}', true);

$log = [
    'received_at' => date('c'),
    'query' => $_GET,
    'body' => $data
];

// Para una demo escolar guardamos la notificación en un archivo.
// En una aplicación real se actualizaría una base de datos.
file_put_contents(
    __DIR__ . '/webhook_log.json',
    json_encode($log, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . PHP_EOL,
    FILE_APPEND
);

http_response_code(200);
echo 'OK';
