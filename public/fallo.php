<?php
declare(strict_types=1);
$paymentId = $_GET['payment_id'] ?? '';
?>
<!doctype html>
<html lang="es">
<head><meta charset="UTF-8"><title>Pago rechazado</title></head>
<body>
    <h1>❌ Pago rechazado</h1>
    <p>El proceso de pago no fue aprobado.</p>
    <?php if ($paymentId !== ''): ?>
        <p>ID de pago: <?= htmlspecialchars($paymentId) ?></p>
    <?php endif; ?>
    <a href="index.php">Intentar nuevamente</a>
</body>
</html>
