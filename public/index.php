<?php
declare(strict_types=1);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Pro - Proyecto Escolar</title>
    <style>
        body { font-family: Arial, sans-serif; background:#f4f4f4; margin:0; }
        .box { max-width:520px; margin:80px auto; background:white; padding:35px; border-radius:14px; box-shadow:0 5px 20px #0001; }
        h1 { margin-top:0; }
        .price { font-size:28px; font-weight:bold; margin:20px 0; }
        button { width:100%; padding:14px; border:0; border-radius:8px; background:#3483fa; color:white; font-size:17px; cursor:pointer; }
        button:hover { opacity:.9; }
        .note { color:#666; font-size:14px; }
    </style>
</head>
<body>
<div class="box">
    <h1>Producto de prueba</h1>
    <p>Integración Mercado Pago Checkout Pro</p>
    <div class="price">$10.000 ARS</div>

    <form action="crear_preferencia.php" method="POST">
        <button type="submit">Pagar con Mercado Pago</button>
    </form>

    <p class="note">
        Este proyecto utiliza credenciales de prueba. No se realizan cobros reales.
    </p>
</div>
</body>
</html>
