<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';

use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

if (configAccessToken() === 'APP_USR-REEMPLAZAR') {
    http_response_code(500);
    exit('Falta configurar el Access Token de prueba en config/config.php o MP_ACCESS_TOKEN.');
}

MercadoPagoConfig::setAccessToken(configAccessToken());
MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);

$baseUrl = configBaseUrl();

$request = [
    'items' => [
        [
            'id' => 'producto-prueba-001',
            'title' => 'Producto de prueba',
            'description' => 'Producto utilizado para demostrar Checkout Pro',
            'currency_id' => 'ARS',
            'quantity' => 1,
            'unit_price' => 10000
        ]
    ],
   // Temporalmente sin URLs de retorno para probar la creación del checkout.
];

$publicUrl = configPublicUrl();
if ($publicUrl !== '') {
    $request['notification_url'] = $publicUrl . '/webhook.php';
}

try {
    $client = new PreferenceClient();

    $requestOptions = new RequestOptions();
    $requestOptions->setCustomHeaders([
        'X-Idempotency-Key: ' . bin2hex(random_bytes(16))
    ]);

    $preference = $client->create($request, $requestOptions);

    if (empty($preference->init_point)) {
        throw new RuntimeException('Mercado Pago no devolvió init_point.');
    }

    header('Location: ' . $preference->init_point);
    exit;

} catch (MPApiException $e) {
    http_response_code(500);
    echo '<h1>Error al crear la preferencia</h1>';
    echo '<pre>';
    echo htmlspecialchars((string)$e->getMessage(), ENT_QUOTES, 'UTF-8');
    if ($e->getApiResponse()) {
        echo "\n\nRespuesta API:\n";
        print_r($e->getApiResponse()->getContent());
    }
    echo '</pre>';
} catch (Throwable $e) {
    http_response_code(500);
    echo '<h1>Error</h1>';
    echo '<pre>' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</pre>';
}
