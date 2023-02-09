<?php

namespace App\Http\Controllers;

use App\Enums\RouteNameEnum;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticationMiddleware;

/**
 *
 */
class EndPointController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {

        $end_points = collect(Route::getRoutes()->get())->map(function ($item, $key) {
            if (collect($item->action)->has("middleware")) {
                if (collect($item->action["middleware"])->contains(AuthenticationMiddleware::class)) {
                    return [
                        "slug" => $item->action["as"],
                        "name" => RouteNameEnum::generateInfoMes($item->action["as"])
                    ];
                }
            }
            return null;
        })->filter()->values();
        return $this->success($end_points)->send();
    }
}
