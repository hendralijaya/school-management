<?php

namespace App\Rules;

use Closure;
use App\Models\Guru;
use App\Models\JabatanGuru;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueJabatanGuru implements ValidationRule
{
    private $guruId;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function __construct(int $guruId = null)
    {
        $this->guruId = $guruId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $jabatanGuru = JabatanGuru::find($value);
        if ($jabatanGuru->nama == 'Kepala Sekolah' || $jabatanGuru->nama == 'Wakil Kepala Sekolah') {
            $existingGuru = Guru::where('jabatan_guru_id', $value)->first();
            if ($existingGuru && (!$this->guruId || $existingGuru->id != $this->guruId)) {
                $fail(trans('validation.unique_jabatan_guru', ['jabatan_guru' => $jabatanGuru->nama]));
            }
        }
    }
}
