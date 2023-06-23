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
        $data = [
            'id' => $this->id,
            "name" => $this->name,
            "surname" => $this->surname,
            "email" => $this->email,
            "status" => $this->status,
            "sex" => $this->sex,
            "start_work" => $this->start_work,
            "end_work" => $this->end_work,
            'roles' => $this->getRoleNames(),
            'position' => PositionResource::make($this->position)
        ];

        if (auth()->user()->hasRole('super_admin')) {
            $data['salary'] = $this->salary;
        }

        if (auth()->user()->id == $this->id or auth()->user()->hasRole('super_admin')) {
            $data['phone'] = $this->phone;
            $data['birth_at'] = $this->birth_at;
        } else {
            $data['phone'] = null;
            $data['birth_at'] = null;
        }
        return $data;
    }
}
