<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Tambahkan alias middleware kustom Anda di sini:
        $middleware->alias([
            'redirect.loggedin.admin' => \App\Http\Middleware\RedirectIfLoggedInToAdmin::class,
        ]);

        // ... middleware lain yang mungkin sudah ada
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
