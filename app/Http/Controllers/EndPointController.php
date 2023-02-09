<?php

namespace App\Http\Controllers;

use App\Enums\RouteNameEnum;
use Illuminate\Http\JsonResponse;

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
        return $this->success(RouteNameEnum::getRouteNames())->send();
    }
}
