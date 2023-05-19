<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
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
            $fail = $exception->getMessage();
            $code = 404;
            $mes = $exception->getTrace();

            if ($exception instanceof ValidationException) {
                $fail = $exception->validator->getMessageBag();
                $mes = 'Girmis oldugunuz verilerini kontrol etmelisiniz';
                $code = 402;
            }
            if ($exception instanceof RecordsNotFoundException) {
                $mes = 'Istenilen kayit bulunamamistir';
            }
            if ($exception instanceof UnauthorizedException) {
                $mes = 'Islem icin yetkisizsiniz';
                $code = 403;
            }

            return $this->fail($fail)->mes($mes)->send($code);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
