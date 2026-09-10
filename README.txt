BASE DE TIENDA PHP + MERCADO PAGO CHECKOUT PRO

1. Requisitos
- PHP 8.2 o superior.
- XAMPP u otro servidor PHP.
- Composer.
- Una aplicación creada en Mercado Pago Developers.

2. Instalar SDK
Desde la carpeta del proyecto ejecutá:

composer require mercadopago/dx-php

3. Configurar credenciales
Abrí config.php y colocá tu Access Token de PRUEBA:

define('MERCADOPAGO_ACCESS_TOKEN', 'TU_ACCESS_TOKEN_DE_PRUEBA');

También modificá BASE_URL si la carpeta tiene otro nombre.

4. Ejecutar
Colocá la carpeta dentro de:

C:\xampp\htdocs\

Por ejemplo:

C:\xampp\htdocs\mercadopago_php_base\

Iniciá Apache desde XAMPP y entrá a:

http://localhost/mercadopago_php_base/

5. Flujo
index.php
    ↓
crear_preferencia.php
    ↓
Mercado Pago Checkout Pro
    ↓
exito.php / fallo.php / pendiente.php

6. IMPORTANTE PARA PRODUCCIÓN
- No confíes en precio/cantidad enviados por el navegador.
- Consultá el producto y precio desde tu base de datos.
- No expongas el Access Token.
- Configurá notificaciones/webhooks.
- Confirmá el estado del pago consultando Mercado Pago desde el servidor antes de entregar el producto.
- Usá HTTPS en producción.

La integración usa Checkout Pro: el comprador es enviado a Mercado Pago para completar el pago.
