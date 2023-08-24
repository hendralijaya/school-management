<?php

namespace App\Http\Requests\API\v1\Libur;

use App\Rules\NoOverlap;
use Illuminate\Foundation\Http\FormRequest;

class GenerateLiburRequest extends FormRequest
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
            'nama_hari_raya' => ['required_with:tanggal_mulai,tanggal_selesai,kategori_hari_id', 'string', 'max:100'],
            'tanggal_mulai' => ['required_with:nama_hari_raya,tanggal_selesai,kategori_hari_id', 'date'],
            'tanggal_selesai' => ['required_with:nama_hari_raya,tanggal_mulai,kategori_hari_id', 'date', 'after_or_equal:tanggal_mulai'],
            'kategori_hari_id' => ['required_with:nama_hari_raya,tanggal_mulai,tanggal_selesai', 'exists:kategori_hari,id'],
            'start_date' => ['required', 'date', new NoOverlap('libur', 'tanggal_mulai', 'tanggal_selesai', request()->input('start_date'), request()->input('end_date'))],
            'end_date' => ['required', 'date', 'after_or_equal:start_date', new NoOverlap('libur', 'tanggal_mulai', 'tanggal_selesai', request()->input('start_date'), request()->input('end_date'))],
        ];
    }
}
