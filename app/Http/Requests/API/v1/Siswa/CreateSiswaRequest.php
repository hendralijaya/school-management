<?php

namespace App\Http\Requests\API\v1\Siswa;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CreateSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role_id === 1;
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

            // siswa
            'nama' => 'required',
            'no_wa' => 'required|string|max:15',
            'gender' => 'required',
            'tgl_bergabung' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
            'status' => 'required',
            'orang_tua_id' => 'required|integer|exists:orang_tua,id',
        ];
    }
}
