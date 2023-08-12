<?php

namespace App\Http\Requests\API\v1\JabatanGuru;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJabatanGuruRequest extends FormRequest
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
            "nama" => "required|string|max:50|unique:jabatan_guru,nama,{$this->route('jabatan_guru')},id",
            "status" => "required|in:A,D",
        ];
    }
}
