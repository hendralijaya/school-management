<?php

namespace App\Http\Requests\API\v1\Libur;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLiburRequest extends FormRequest
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
            'nama_hari_raya' => ['required', 'string', 'max:100'],
            'tanggal_mulai' => ['required', 'date', 'unique:libur,tanggal_mulai,' . $this->libur->id, 'before_or_equal:tanggal_selesai'],
            'tanggal_selesai' => ['required', 'date', 'unique:libur,tanggal_selesai,' . $this->libur->id, 'after_or_equal:tanggal_mulai'],
            'kategori_hari_id' => ['required', 'exists:kategori_hari,id'],
        ];
    }
}
