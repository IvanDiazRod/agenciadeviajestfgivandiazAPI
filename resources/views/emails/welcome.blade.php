<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Estilos básicos para que se vea bien en todos los gestores de correo */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            background-color: #1e3a8a; /* Azul oscuro similar a tu diseño */
            padding: 40px 20px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            letter-spacing: 1px;
        }
        .content {
            padding: 40px 30px;
            color: #334155;
            line-height: 1.6;
        }
        .content h2 {
            color: #1e3a8a;
            font-size: 22px;
            margin-top: 0;
        }
        .footer {
            background-color: #f8fafc;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #ea580c; /* Naranja para resaltar, como un CTA */
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Encabezado con el nombre de tu marca -->
        <div class="header">
            <h1>TRAVEL AGENCY</h1>
        </div>

        <!-- Cuerpo del mensaje -->
        <div class="content">
            <h2>¡Hola, viajero! ✈️</h2>
            <p>Es un placer saludarte. Te confirmamos que te has suscrito correctamente a nuestra newsletter.</p>
            <p>A partir de ahora, serás el primero en recibir:</p>
            <ul>
                <li>Ofertas exclusivas en destinos seleccionados.</li>
                <li>Guías de viaje para tus próximas aventuras.</li>
                <li>Consejos para viajar de forma inteligente.</li>
            </ul>
            <p>Estamos preparando cosas increíbles para ti. ¡No te las pierdas!</p>
            
            <a href="{{ config('app.url') }}" class="button">Visitar nuestra web</a>
        </div>

        <!-- Pie de página -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Travel Agency. Todos los derechos reservados.</p>
            <p>Has recibido este correo porque te suscribiste en nuestro sitio web.</p>
        </div>
    </div>
</body>
</html>