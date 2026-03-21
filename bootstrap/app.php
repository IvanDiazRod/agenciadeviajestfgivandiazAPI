<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // Asegúrate de que esta línea esté aquí
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Esta línea habilita el CORS automáticamente para las rutas de API
        $middleware->statefulApi();
        
        // Opcional: Si Axios te da problemas con el token CSRF en la API
        $middleware->validateCsrfTokens(except: [
            'api/*', 
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();