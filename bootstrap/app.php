<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

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
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                $code = 500;
                $message = $e->getMessage() ?: 'Internal Server Error';
                $errors = [];

                if ($e instanceof ValidationException) {
                    $code = 422;
                    $message = $e->getMessage();
                    $errors = $e->errors();
                } elseif ($e instanceof HttpExceptionInterface) {
                    $code = $e->getStatusCode();
                } elseif ($e instanceof AuthenticationException) {
                    $code = 401;
                    $message = 'Unauthenticated';
                } elseif ($e instanceof ModelNotFoundException) {
                    $code = 404;
                    $message = 'Resource not found';
                }

                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'errors' => $errors,
                ], $code);
            }
        });
    })->create();
