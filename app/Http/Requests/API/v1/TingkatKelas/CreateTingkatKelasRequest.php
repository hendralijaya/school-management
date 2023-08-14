<?php

namespace App\Http\Requests\API\v1\TingkatKelas;

use App\Models\Jurusan;
use App\Rules\CheckRelatedStatus;
use Illuminate\Foundation\Http\FormRequest;

class CreateTingkatKelasRequest extends FormRequest
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
            'nama' => 'required|string|max:50',
            'status' => 'required|string|in:A,D',
            'jurusan_id' => ['required', 'integer', 'exists:jurusan,id', new CheckRelatedStatus(Jurusan::class)]
        ];
    }
}
