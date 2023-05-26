<?php

namespace App\Traits;

use App\Enums\RouteName;
use App\Repositories\HistoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 *
 */
trait ResponseTrait
{

    /**
     * @param $data
     * @return JsonResponse
     */
    public function okPaginate($data = null): JsonResponse
    {
        (new HistoryRepository())->create();
        DB::commit();

        $data = $data->response()->getData(true);
        return response()->json([
            "information" => [RouteName::statusNote() . " " . "Basarili"],
            "data" => $data['data'],
            "links" => $data['links'],
            "meta" => $data['meta'],
        ]);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function ok($data = null): JsonResponse
    {
        (new HistoryRepository())->create();
        DB::commit();
        return response()->json([
            "information" => [RouteName::statusNote() . " " . "Basarili"],
            "data" => $data,
        ]);
    }

    /**
     * @param string|null $note
     * @param $fail
     * @return JsonResponse
     */
    public function error(string $note = null, $fail = null): JsonResponse
    {
        DB::rollBack();
        (new HistoryRepository())->create(0);
        return response()->json([
            "information" => [RouteName::statusNote() . " " . "Basarisiz", $note],
            "fail" => $fail
        ], 400);
    }
}
