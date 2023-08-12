<?php

namespace App\Http\Requests\API\v1\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
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
            // user
            'email' => 'required|string|email|unique:user',
            'password' => 'required|string|min:6',

            // admin
            'nama' => 'required|string',
            'no_wa' => 'required|regex:/^\+\d{1,14}$/',
            'gender' => 'required|in:L,P',
            'status' => 'required',
        ];
    }
}
