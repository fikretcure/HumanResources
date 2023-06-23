<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class MembershipInvitationsUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'users' => [
                'array',
                'required',
            ],
            'users.*.email' => [
                'string',
                "email:rfc,dns",
                'required',
                'distinct',
                Rule::unique(User::class, 'email')
            ],
            'users.*.name' => [
                'string',
                'required',
            ],
            'users.*.surname' => [
                'string',
                'required',
            ],
            'users.*.sex' => [
                'string',
                'required',
                Rule::in(['Bay', 'Bayan'])
            ],
            'users.*.start_work' => [
                'date',
                'required',
            ],
        ];
    }
}
