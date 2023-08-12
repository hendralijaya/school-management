<?php

namespace App\Http\Requests\API\v1\KategoriKegiatan;

use Illuminate\Foundation\Http\FormRequest;

class CreateKategoriKegiatanRequest extends FormRequest
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
            "nama_kategori" => "required|string|max:50|unique:kategori_kegiatan,nama_kategori",
            "status" => "required|in:A,D",
        ];
    }
}
