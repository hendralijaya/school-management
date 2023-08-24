<?php

namespace App\Http\Requests\API\v1\Jurusan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJurusanRequest extends FormRequest
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
            'nama' => 'required|string|max:50|unique:jurusan,nama,' . $this->jurusan->id,
            'status' => 'required|string|in:A,D',
        ];
    }
}
