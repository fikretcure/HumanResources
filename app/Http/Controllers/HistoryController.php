<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class HistoryController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return $this->success(History::all())->send();
    }
}
