<?php

use App\Http\Middleware\AddToTokenResponse;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Passport\Http\Middleware\CheckClientCredentials;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Configuración de la aplicación.
 *
 * Este archivo configura la aplicación utilizando el método `Application::configure()`.
 * 
 * - Establece la ruta base de la aplicación.
 * - Configura las rutas web, API, comandos de consola y la ruta de salud.
 * - Define alias para middlewares.
 * - Maneja excepciones y define una respuesta JSON personalizada para errores 404 en rutas API.
 *
 * @return \Application
 */
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'client' => CheckClientCredentials::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => 'Not found.',
                    'debug' => $e->getMessage(),
                ], 404);
            }
        });
    })->create();
