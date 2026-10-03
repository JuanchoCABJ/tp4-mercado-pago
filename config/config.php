<?php
declare(strict_types=1);

/*
 * Configuración central del proyecto.
 * Para una entrega real, no publiques el Access Token.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;

$accessToken = getenv('MP_ACCESS_TOKEN') ?: '';

// Para facilitar el uso en XAMPP, también acepta un token colocado aquí.
// Reemplazá SOLO este valor si no querés usar variables de entorno.
if ($accessToken === '') {
    $accessToken = 'APP_USR-REEMPLAZAR';
}

if ($accessToken === '' || $accessToken === 'APP_USR-REEMPLAZAR') {
    // El proyecto seguirá cargando, pero crear_preferencia.php mostrará un error claro.
} else {
    MercadoPagoConfig::setAccessToken($accessToken);
    MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
}

$baseUrl = getenv('BASE_URL') ?: 'http://localhost/mercadopago_checkout_pro/public';
$publicUrl = getenv('PUBLIC_URL') ?: '';
$webhookSecret = getenv('MP_WEBHOOK_SECRET') ?: '';

function configAccessToken(): string {
    $token = getenv('MP_ACCESS_TOKEN') ?: '';
    if ($token === '') {
        $token = 'APP_USR-5196449776727547-090420-20ae4ccd1316a42396527a4948a1e18b-1577049737';
    }
    return $token;
}

function configBaseUrl(): string {
    return rtrim(getenv('BASE_URL') ?: 'http://localhost/mercadopago_checkout_pro/public', '/');
}

function configPublicUrl(): string {
    return rtrim(getenv('PUBLIC_URL') ?: '', '/');
}

function configWebhookSecret(): string {
    return getenv('MP_WEBHOOK_SECRET') ?: '';
}
