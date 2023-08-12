<?php

namespace App\Http\Requests\API\v1\Kurikulum;

use Illuminate\Foundation\Http\FormRequest;

class CreateKurikulumRequest extends FormRequest
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
            'nama' => 'required|string|max:50|unique:kurikulum,nama',
            'tahun' => 'required|integer',
            'status' => 'required|in:A,D',
        ];
    }
}
