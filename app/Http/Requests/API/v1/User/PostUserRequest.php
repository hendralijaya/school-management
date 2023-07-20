<?php

namespace App\Http\Requests\API\v1\User;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6',
            'status' => [
                'required',
                'string',
                'max:1',
                Rule::in(['D', 'A']),
            ],
        ];
    }
}
