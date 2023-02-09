<?php

namespace App\Http\Requests;

use App\Enums\UnitTypeEnum;
use App\Models\Unit;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnitUpdateRequest extends FormRequest
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
            "name" => [
                "string",
                Rule::unique(Unit::class)->ignore($this->id)
            ],
            "parent_id" => [
                "integer",
                Rule::exists(Unit::class, "id")
            ],
            "type" => [
                "integer",
                Rule::enum(UnitTypeEnum::class)
            ]
        ];
    }
}
