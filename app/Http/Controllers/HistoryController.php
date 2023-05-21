<?php

namespace App\Http\Controllers;

use App\Http\Resources\HistoryResource;
use App\Models\History;
use App\Repositories\HistoryRepository;
use Illuminate\Http\JsonResponse;

/**
 *
 */
class HistoryController extends Controller
{

    /**
     * @var HistoryRepository
     */
    private HistoryRepository $historyRepository;

    /**
     *
     */
    public function __construct()
    {
        $this->middleware('role:super_admin')->only('update', 'store', 'destroy');
        $this->historyRepository = new HistoryRepository();
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successSendPagination(HistoryResource::collection($this->historyRepository->paginate()));
    }

    /**
     * @param History $history
     * @return JsonResponse
     */
    public function show(History $history): JsonResponse
    {
        return $this->successSend(HistoryResource::make($history));
    }

}
