<?php
require_once __DIR__ . '/vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;

// IMPORTANTE:
// Colocá tu Access Token en config.php.
// Nunca pongas el Access Token en HTML o JavaScript.
require_once __DIR__ . '/config.php';

MercadoPagoConfig::setAccessToken(MERCADOPAGO_ACCESS_TOKEN);

$producto = $_POST['producto'] ?? 'Producto de prueba';
$precio = isset($_POST['precio']) ? (float) $_POST['precio'] : 10000;
$cantidad = isset($_POST['cantidad']) ? (int) $_POST['cantidad'] : 1;

// En un proyecto real, el precio debe salir de tu base de datos
// y no confiarse en un valor enviado por el navegador.

$client = new PreferenceClient();

try {
    $preference = $client->create([
        "items" => [
            [
                "title" => $producto,
                "quantity" => $cantidad,
                "unit_price" => $precio,
                "currency_id" => "ARS"
            ]
        ],
        "back_urls" => [
            "success" => BASE_URL . "/exito.php",
            "failure" => BASE_URL . "/fallo.php",
            "pending" => BASE_URL . "/pendiente.php"
        ],
        "auto_return" => "approved",
        "external_reference" => "PEDIDO-" . time()
    ]);

    // Checkout Pro devuelve el enlace para iniciar el pago.
    header("Location: " . $preference->init_point);
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo "No se pudo crear la preferencia de pago.";
    // En desarrollo podés registrar $e->getMessage() en un log.
}
