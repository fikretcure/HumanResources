<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            "name" => $this->name,
            "surname" => $this->surname,
            "phone" => $this->phone,
            "email" => $this->email,
            "status" => $this->status,
            "birth_at" => $this->birth_at,
            "sex" => $this->sex,
            "start_work" => $this->start_work,
            "end_work" => $this->end_work,
            'roles' => $this->getRoleNames()
        ];
    }
}
