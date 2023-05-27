<?php

namespace App\Traits;

use App\Enums\RouteName;
use App\Jobs\CreateHistoryJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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
        $history_data = [
            'data' => json_encode([
                'route' => RouteName::statusNote(),
                'request' => request()->except('password'),
                'url' => request()->url()
            ]),
            'user_id' => Auth::check() ? Auth::id() : 0,
            'status' => 1
        ];

        CreateHistoryJob::dispatch($history_data);
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
        $history_data = [
            'data' => json_encode([
                'route' => RouteName::statusNote(),
                'request' => request()->except('password'),
                'url' => request()->url()
            ]),
            'user_id' => Auth::check() ? Auth::id() : 0,
            'status' => 1
        ];

        CreateHistoryJob::dispatch($history_data);
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
        $history_data = [
            'data' => json_encode([
                'route' => RouteName::statusNote(),
                'request' => request()->except('password'),
                'url' => request()->url()
            ]),
            'user_id' => Auth::check() ? Auth::id() : 0,
            'status' => 0
        ];

        CreateHistoryJob::dispatch($history_data);


        return response()->json([
            "information" => [RouteName::statusNote() . " " . "Basarisiz", $note],
            "fail" => $fail
        ], $status_code ?? 400);
    }
}
