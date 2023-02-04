<?php

namespace App\Http\Requests;

use App\Enums\RoleEnum;
use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
                "required",
                "string"
            ],
            "surname" => [
                "required",
                "string"
            ],
            "email" => [
                "required",
                "string",
                "email:rfc,dns",
                Rule::unique(User::class)
            ],
            "status" => [
                "required",
                "integer",
                Rule::enum(StatusEnum::class)
            ],
            "role_state" => [
                "required",
                Rule::enum(RoleEnum::class),
                Rule::notIn([RoleEnum::superAdmin->value])
            ],
        ];
    }
}
