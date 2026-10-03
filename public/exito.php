<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';

$paymentId = $_GET['payment_id'] ?? '';
$status = $_GET['status'] ?? '';
$externalReference = $_GET['external_reference'] ?? '';
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago aprobado</title>
    <style>
        body { font-family:Arial; background:#f4f4f4; }
        .box { max-width:600px; margin:80px auto; background:#fff; padding:35px; border-radius:14px; }
        .ok { font-size:48px; }
    </style>
</head>
<body>
<div class="box">
    <div class="ok">✅</div>
    <h1>Pago aprobado</h1>
    <p>Mercado Pago informó un retorno exitoso.</p>

    <ul>
        <li><strong>ID de pago:</strong> <?= htmlspecialchars((string)$paymentId) ?></li>
        <li><strong>Estado recibido:</strong> <?= htmlspecialchars((string)$status) ?></li>
        <li><strong>Referencia:</strong> <?= htmlspecialchars((string)$externalReference) ?></li>
    </ul>

    <p>
        Para confirmar el estado definitivo desde el backend, el sistema debe consultar
        el pago mediante la API usando el ID recibido.
    </p>

    <a href="index.php">Volver al inicio</a>
</div>
</body>
</html>
