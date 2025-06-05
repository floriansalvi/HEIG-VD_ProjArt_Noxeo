<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Throwable;

class Handler extends ExceptionHandler {
    public function render($request, Throwable $exception) {
    
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'status' => 'error',
                'error' => 'Ressource not found',
            ], 404);
        }

        if ($exception instanceof ValidationException) {
            return response()->json([
                'status' => 'error',
                'error' => $exception->errors()
            ], 422);
        }

        if ($exception instanceof QueryException) {
            return response()->json([
                    'status' => 'error',
                    'error' => 'A database error occured.',
            ], 500);
        }

        // Catch-all pour toutes les autres exceptions
        return response()->json([
                    'status' => 'error',
                    'error' => 'An unexpected error occured.',
        ], 500);
    }
}