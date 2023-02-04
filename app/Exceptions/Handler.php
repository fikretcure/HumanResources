<?php

namespace App\Exceptions;

use App\Traits\Responsed;
use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    use Responsed;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (Throwable $exception, $request) {
            if ($exception instanceof ValidationException) {
                return $this->fail($exception->validator->getMessageBag())->mes("validation")->send(402);
            }

            if ($exception->getPrevious() instanceof RecordsNotFoundException) {
                return $this->fail($exception->getMessage())->mes('İşlemini yapmak istediğiniz kayıt malesef bulunamadı.Yolunda gitmeyen bir şeyler var !')->send();
            }

            return $this->fail($exception->getMessage())->mes($exception->getMessage())->send(402);
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
