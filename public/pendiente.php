<?php
declare(strict_types=1);
$paymentId = $_GET['payment_id'] ?? '';
?>
<!doctype html>
<html lang="es">
<head><meta charset="UTF-8"><title>Pago pendiente</title></head>
<body>
    <h1>⏳ Pago pendiente</h1>
    <p>Mercado Pago informó que el pago todavía no está aprobado.</p>
    <?php if ($paymentId !== ''): ?>
        <p>ID de pago: <?= htmlspecialchars($paymentId) ?></p>
    <?php endif; ?>
    <a href="index.php">Volver al inicio</a>
</body>
</html>
