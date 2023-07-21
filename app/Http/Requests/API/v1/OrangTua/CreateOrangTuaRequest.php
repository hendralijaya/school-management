<?php

namespace App\Http\Requests\API\v1\OrangTua;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrangTuaRequest extends FormRequest
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
            // User
            'email' => 'required|string|email|unique:user',
            'password' => 'required|string|min:6',
            // Orang Tua
            'nama' => 'required|string',
            'no_wa' => 'required|string|max:15',
            'gender' => 'required|string',
            'tgl_lahir' => 'required|string',
            'alamat' => 'required|string',
            'status' => 'required|string',
        ];
    }
}
