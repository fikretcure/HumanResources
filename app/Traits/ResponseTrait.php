<?php

namespace App\Traits;

use App\Enums\RouteName;
use App\Jobs\CreateHistoryJob;
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
        CreateHistoryJob::dispatch();
        return response()->json([
            "information" => [RouteName::statusNote() . " " . "Basarili"],
            "data" => $data,
        ]);
    }

    /**
     * @param string|null $note
     * @param null $fail
     * @param int|null $status_code
     * @return JsonResponse
     */
    public function error(string $note = null, $fail = null, int $status_code = null): JsonResponse
    {
        DB::rollBack();
        return response()->json([
            "information" => [RouteName::statusNote() . " " . "Basarisiz", $note],
            "fail" => $fail
        ], $status_code ?? 400);
    }
}
