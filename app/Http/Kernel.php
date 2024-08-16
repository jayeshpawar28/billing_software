<?php 
// app/Http/Kernel.php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        // Other global middleware
         // ...
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\Auth\Middleware\Authenticate::class,
    \App\Http\Middleware\ValidMiddleware::class,
    // ...
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        // Other route middleware
        // 'validuser' => \App\Http\Middleware\ValidMiddleware::class,

    ];
}
