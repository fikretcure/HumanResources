<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Illuminate\Http\Request;

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
        $this->renderable(function (ValidationException $e, Request $request) {
            return $this->fail([
                "errors" => $e->validator->getMessageBag(),
                "inputs" => $request->all()
            ])->mes('Form verilerinizi kontrol etmelisiniz')->send(401);
        });

        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            return $this->fail($e->getMessage())->mes('Islem yapmak istediginiz kayit bulunamadi')->send();
        });

        $this->renderable(function (UnauthorizedException $e, Request $request) {
            return $this->fail($e->getMessage())->mes('Islem yapmak icin yetkili degilsiniz')->send(403);
        });

        $this->renderable(function (QueryException $e, Request $request) {
            return $this->fail([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
            ])->mes('Sql komutunuzu kontrol etmelisiniz')->send();
        });

        $this->renderable(function (Throwable $e, Request $request) {
            return $this->fail([
                'message' => $e->getMessage(),
                'trace' => $e->getTrace(),
                'file' => $e->getFile(),
            ])->mes('Bilinmeyen Hata Firlatmasi')->send();
        });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
