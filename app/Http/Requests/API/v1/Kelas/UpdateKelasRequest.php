<?php

namespace App\Http\Requests\API\v1\Kelas;

use App\Rules\UniqueTogetherColumns;
use Illuminate\Foundation\Http\FormRequest;

class UpdateKelasRequest extends FormRequest
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
            'nama' => ['required', 'string', 'max:50', new UniqueTogetherColumns('kelas', ['nama' => $this->input('nama'), 'tingkat_kelas_id' => $this->input('tingkat_kelas_id')])],
            'status' => 'required|string|in:A,D',
            'tingkat_kelas_id' => 'required|exists:tingkat_kelas,id',
        ];
    }
}
