<?php

use App\Http\Middleware\FootprintsMiddleware;
use App\Http\Middleware\RolePermissionMiddleware;
use App\Http\Middleware\TransactionIDMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->use([
            FootprintsMiddleware::class,
            TransactionIDMiddleware::class,
        ]);

        $middleware->alias([
            'footprints' => FootprintsMiddleware::class,
            'user.permission' => RolePermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
