<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                $code = 500;
                $message = $e->getMessage() ?: 'Internal Server Error';
                $errors = [];

                if ($e instanceof \Illuminate\Validation\ValidationException) {
                    $code = 422;
                    $message = $e->getMessage();
                    $errors = $e->errors();
                } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface) {
                    $code = $e->getStatusCode();
                } elseif ($e instanceof \Illuminate\Auth\AuthenticationException) {
                    $code = 401;
                    $message = 'Unauthenticated';
                } elseif ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                    $code = 404;
                    $message = 'Resource not found';
                }

                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'errors'  => $errors,
                ], $code);
            }
        });
    })->create();
