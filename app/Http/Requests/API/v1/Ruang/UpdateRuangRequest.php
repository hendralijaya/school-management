<?php

namespace App\Http\Requests\API\v1\Ruang;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRuangRequest extends FormRequest
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
            'nama' => 'required|string',
            'kapasitas' => 'required|integer',
            'status' => 'required|string|in:A,D',
        ];
    }
}
