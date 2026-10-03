# Integración Mercado Pago - Checkout Pro

Proyecto escolar para demostrar la integración de Mercado Pago Checkout Pro con PHP.

## 1. Requisitos

- XAMPP
- PHP 8.2 o superior
- Composer
- Una aplicación creada en Mercado Pago Developers
- Credenciales de prueba de Mercado Pago

La versión actual del SDK oficial utilizada por este proyecto es `mercadopago/dx-php` 3.10.0.

## 2. Instalar el proyecto

Copiar la carpeta `mercadopago_checkout_pro` dentro de:

```text
C:\xampp\htdocs\
```

Abrir una terminal en esa carpeta:

```bash
cd C:\xampp\htdocs\mercadopago_checkout_pro
composer install
```

Si todavía no existe `composer.json`/`vendor`, también se puede ejecutar:

```bash
composer require "mercadopago/dx-php:3.10.0"
```

## 3. Configurar el Access Token

En Mercado Pago Developers:

1. Entrar a Tus integraciones.
2. Crear o seleccionar la aplicación.
3. Seleccionar Checkout Pro.
4. Ir a Pruebas > Credenciales de prueba.
5. Copiar el Access Token de prueba.

El token debe ser utilizado únicamente en el backend.

Para una prueba rápida, abrir:

```text
config/config.php
```

y reemplazar:

```php
'APP_USR-REEMPLAZAR'
```

por el Access Token de prueba.

IMPORTANTE: no compartir ni publicar el Access Token.

## 4. Ejecutar

Iniciar Apache desde XAMPP.

Abrir:

```text
http://localhost/mercadopago_checkout_pro/public/
```

Presionar:

```text
Pagar con Mercado Pago
```

La aplicación crea una Preference y redirige al Checkout Pro.

## 5. Probar el pago

Mercado Pago recomienda utilizar una cuenta de prueba comprador para realizar la compra de prueba.

La cuenta comprador se encuentra en:

Tus integraciones > tu aplicación > Cuentas de prueba > Comprador.

Realizar la compra desde una ventana de incógnito y utilizar las credenciales de la cuenta comprador de prueba.

## 6. Webhooks

El archivo:

```text
public/webhook.php
```

recibe las notificaciones de Mercado Pago.

Mercado Pago no puede enviar Webhooks directamente a `localhost`. Para probarlos con XAMPP se necesita una URL HTTPS pública, por ejemplo mediante un túnel de desarrollo.

Cuando tengas una URL pública:

```text
https://TU-DOMINIO/public
```

configurá:

```text
PUBLIC_URL=https://TU-DOMINIO
```

y en Mercado Pago configurá Webhooks > Pagos con:

```text
https://TU-DOMINIO/webhook.php
```

También se debe colocar en `MP_WEBHOOK_SECRET` la clave secreta proporcionada por Mercado Pago.

El proyecto valida `x-signature` cuando se configura la clave secreta.

## 7. Aclaración sobre pagos de prueba y Webhooks

Mercado Pago indica actualmente que los pagos de prueba creados con credenciales de prueba no envían notificaciones automáticamente. La recepción del Webhook puede verificarse mediante la opción de simulación de Webhooks desde el panel de Mercado Pago.

Por eso, para la demostración escolar conviene mostrar:

1. Creación de Preference.
2. Redirección al Checkout Pro.
3. Pago aprobado con usuario comprador de prueba.
4. Retorno a `exito.php`.
5. Configuración y simulación del Webhook `payment`.

## 8. Flujo del proyecto

```text
index.php
    |
    | POST
    v
crear_preferencia.php
    |
    | Preference API
    v
Mercado Pago Checkout Pro
    |
    | pago de prueba
    v
exito.php / fallo.php / pendiente.php

Además:

Mercado Pago
    |
    | Webhook HTTPS POST
    v
webhook.php
    |
    v
registro de notificación
```

## 9. Archivos principales

- `public/index.php`: interfaz mínima.
- `public/crear_preferencia.php`: crea la Preference.
- `public/exito.php`: recibe el retorno de pago aprobado.
- `public/fallo.php`: recibe pagos rechazados.
- `public/pendiente.php`: recibe pagos pendientes.
- `public/webhook.php`: receptor de Webhooks.
- `config/config.php`: configuración y credenciales.
- `composer.json`: dependencia del SDK.
- `.env.example`: ejemplo de variables de configuración.

## 10. Qué se demuestra en la evaluación

Este proyecto demuestra:

- Uso del SDK oficial de Mercado Pago.
- Configuración de credenciales de prueba.
- Creación de preferencias de pago.
- Redirección a Checkout Pro.
- URLs de retorno.
- Manejo de estados aprobado, rechazado y pendiente.
- Recepción de Webhooks.
- Validación de firma de Webhooks cuando se configura la clave secreta.
- Uso de `X-Idempotency-Key` al crear la preferencia.

## Fuentes oficiales

Documentación de Checkout Pro:
https://www.mercadopago.com.ar/developers/es/docs/checkout-pro

Crear Preference:
https://www.mercadopago.com.ar/developers/es/docs/checkout-pro/create-payment-preference

Pruebas:
https://www.mercadopago.com.ar/developers/es/docs/checkout-pro/integration-test

Webhooks:
https://www.mercadopago.com.ar/developers/es/docs/checkout-pro/payment-notifications

SDK oficial PHP:
https://github.com/mercadopago/sdk-php
