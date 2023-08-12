<?php

namespace App\Http\Requests\API\v1\JenisTingkatLomba;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJenisTingkatLombaRequest extends FormRequest
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
            "nama_jenis_lomba" => "required|string|max:50|unique:jenis_tingkat_lomba,nama_jenis_lomba," . $this->jenisTingkatLomba->id,
            "status" => "required|in:A,D",
        ];
    }
}
