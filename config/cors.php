<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout'], // Añade login/logout si no están bajo api/

    'allowed_methods' => ['*'],

    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // ¡CAMBIA ESTO A TRUE!
    'supports_credentials' => true, 
];