<?php

namespace App\Http\Requests;

use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'string',
                Rule::notIn('null')
            ],
            'surname' => [
                'sometimes',
                'string',
                Rule::notIn('null')
            ],
            'phone' => [
                'sometimes',
                'numeric',
                Rule::unique(User::class)->ignore($this->user)
            ],
            'email' => [
                'sometimes',
                'email:rfc,dns',
                Rule::unique(User::class)->ignore($this->user)
            ],
            'status' => [
                'sometimes',
                'boolean'
            ],
            'birth_at' => [
                'sometimes',
                'date_format:Y-m-d'
            ],
            'start_work' => [
                'sometimes',
                'date_format:Y-m-d'
            ],
            'end_work' => [
                'sometimes',
                'date_format:Y-m-d'
            ],
        ];
    }
}
