<?php

namespace App\Http\Requests\API\v1\Guru;

use App\Models\Guru;
use App\Models\JabatanGuru;
use Illuminate\Validation\Rule;
use App\Rules\UniqueJabatanGuru;
use Illuminate\Foundation\Http\FormRequest;

class CreateGuruRequest extends FormRequest
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
            'status' => 'required|string|in:A,D',

            // guru
            'jabatan_guru_id' => [
                'required',
                new UniqueJabatanGuru,
            ],
            'nama' => 'required',
            'no_wa' => 'required',
            'gender' => 'required',
            'tgl_bergabung' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ];
    }
}
