<?php

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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            '/login-biometrik',
            'login-biometrik',
        ]);
        
        // --- SAYA SUDAH MENAMBAHKAN INI UNTUK ANDA ---
        $middleware->alias([
            // Untuk role Admin (dari dashboard admin Anda)
            'admin' => \App\Http\Middleware\RoleMiddleware::class . ':admin',
            
            // Untuk role Pelamar
            'pelamar' => \App\Http\Middleware\RoleMiddleware::class . ':pelamar',
            
            // Untuk role Pembimbing (yang baru kita buat)
            'pembimbing' => \App\Http\Middleware\RoleMiddleware::class . ':pembimbing',
            
            // Untuk role Orang Tua
            'orang_tua' => \App\Http\Middleware\RoleMiddleware::class . ':orang_tua',
        ]);
        // ----------------------------------------------

    })
    ->withExceptions(function (Exceptions $exceptions) {
        // ...
    })->create();