<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Traits\ResponseTrait;

class Handler extends ExceptionHandler
{
    use ResponseTrait
    
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
