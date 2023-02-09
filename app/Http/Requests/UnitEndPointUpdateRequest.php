<?php

namespace App\Http\Requests;

use App\Models\Unit;
use App\Models\UnitEndPoints;
use App\Rules\RouteNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnitEndPointUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "unit_id" => [
                "required",
                "integer",
                Rule::exists(Unit::class, "id"),
                Rule::unique(UnitEndPoints::class, "id")->where("end_point_slug", $this->end_point_slug),
            ],
            "end_point_slug" => [
                "required",
                "string",
                Rule::unique(UnitEndPoints::class, "end_point_slug")->where("unit_id", $this->unit_id),
                (new RouteNameRule())
            ]
        ];
    }
}
