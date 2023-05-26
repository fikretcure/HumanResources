<?php

namespace App\Traits;


use App\Enums\RouteName;
use App\Models\History;
use App\Repositories\HistoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 *
 */
trait ResponseTrait
{

    /**
     * @var mixed
     */
    private mixed $data;

    /**
     * @var mixed
     */
    private mixed $note;

    /**
     * @var mixed
     */
    private mixed $status_note;

    /**
     * @var int
     */
    private int $status;

    /**
     * @param $data
     * @return $this
     */
    public function success($data = null): static
    {
        (new HistoryRepository())->create();

        DB::commit();

        $this->data = $data;
        $this->status = 200;
        $this->status_note = 'Basarili';
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function fail($data = null): static
    {
        DB::rollBack();

        History::create([
            'data' => json_encode([
                'route' => RouteName::statusNote(),
                'request' => request()->all()
            ]),
            'user_id' => Auth::check() ? Auth::id() : 0,
            'status' => 0
        ]);

        $this->data = $data;
        $this->status = 404;
        $this->status_note = 'Basarisiz';
        return $this;
    }


    /**
     * @param int|null $status
     * @return JsonResponse
     */
    public function send(int $status = null): JsonResponse
    {
        return response()->json([
            "status_note" => RouteName::statusNote() . " " . $this->status_note ?? null,
            "note" => $this->note ?? null,
            "data" => $this->data ?? null,
        ], $status ?? $this->status);
    }

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
            "status_note" => RouteName::statusNote() . " Basarili",
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
     * @return JsonResponse
     */
    public function error(string $note = null): JsonResponse
    {
        DB::rollBack();
        (new HistoryRepository())->create(0);
        return response()->json([
            "information" => [RouteName::statusNote() . " " . "Basarisiz", $note],
        ], 400);
    }

    public function exp(string $note = null, $fail = null): JsonResponse
    {
        DB::rollBack();
        (new HistoryRepository())->create(0);
        return response()->json([
            "information" => [RouteName::statusNote() . " " . "Basarisiz", $note],
            "fail" => $fail
        ], 400);
    }

}
