<?php

class Kernel
{
    protected $middlewareGroups = [
        'web' => [
            // ...
        ],

        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class, // <--- ADICIONE ESTA LINHA
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
}