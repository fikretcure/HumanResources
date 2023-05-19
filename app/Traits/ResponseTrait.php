<?php

namespace App\Traits;


use App\Enums\RouteName;
use App\Models\History;
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
        History::create([
            'data' => json_encode([
                'route' => RouteName::statusNote(),
                'request' => request()->all()
            ]),
            'user_id' => Auth::id(),
            'status' => 1
        ]);

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
     * @param string|null $note
     * @return $this
     */
    public function mes(string $note = null): static
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @param $note
     * @return $this
     */
    public function failMes($note = null): static
    {
        $this->note = $note;
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
}
