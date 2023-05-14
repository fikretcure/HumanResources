<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseTrait;

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
        $this->renderable(function (Throwable $exception) {
            if ($exception instanceof ValidationException) {
                return $this->fail($exception->validator->getMessageBag())->send(402);
            }

            if ($exception->getPrevious() instanceof RecordsNotFoundException) {
                return $this->fail($exception->getMessage())->send();
            }
            return $this->fail($exception->getMessage())->send();
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
