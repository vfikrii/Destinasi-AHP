<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
        
        $middleware->redirectTo(
            guests: '/login',
            users: function (\Illuminate\Http\Request $request) {
                return auth()->check() && auth()->user()->role === 'admin' 
                    ? '/admin/dashboard' 
                    : '/dashboard';
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
