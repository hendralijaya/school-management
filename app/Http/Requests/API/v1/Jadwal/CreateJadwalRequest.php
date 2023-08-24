<?php

namespace App\Http\Requests\API\v1\Jadwal;

use Illuminate\Foundation\Http\FormRequest;

class CreateJadwalRequest extends FormRequest
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
            'mata_pelajaran_id' => 'required|exists:mata_pelajaran,id',
            'guru_id' => 'required|exists:guru,id',
            'ruang_id' => 'required|exists:ruang,id',
            'kelas_id' => 'required|exists:kelas,id',
            'hari_id' => 'required|exists:hari,id',
            'waktu_id' => 'required|exists:waktu,id',
            'status' => 'required|string|in:A,D',
        ];
    }
}
