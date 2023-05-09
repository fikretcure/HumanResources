<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;

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
        $this->data = $data;
        $this->status = 200;
        $this->status_note = "Başarılı";

        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function fail($data = null): static
    {
        $this->data = $data;
        $this->status = 404;
        $this->status_note = "Başarısız";

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
        $this->status_note = "Başarısız";

        return $this;
    }

    /**
     * @param int|null $status
     * @return JsonResponse
     */
    public function send(int $status = null): JsonResponse
    {
        return response()->json([
            "status_note" => $this->status_note ?? null,
            "note" => $this->note ?? null,
            "data" => $this->data ?? null,
        ], $status ?? $this->status);
    }
}
