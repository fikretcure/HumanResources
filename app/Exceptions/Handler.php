<?php

namespace App\Exceptions;

use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $exception, $request) {
            if ($exception instanceof ValidationException) {
                return response()->json('a1');
            }

            if ($exception->getPrevious() instanceof RecordsNotFoundException) {
                return response()->json('a2');
            }
            //return response()->json($exception->getMessage());
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
