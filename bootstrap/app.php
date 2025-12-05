<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckIsLogin;
use App\Http\Middleware\CheckRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(function (Middleware $middleware) {

        // alias semua middleware di sini
        $middleware->alias([
            'checkislogin' => CheckIsLogin::class,
            'checkrole'    => CheckRole::class,
        ]);
    })
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
