<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class NoOverlap implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected $table;
    protected $startColumn;
    protected $endColumn;
    protected $startDate;
    protected $endDate;

    public function __construct($table, $startColumn, $endColumn, $startDate, $endDate)
    {
        $this->table = $table;
        $this->startColumn = $startColumn;
        $this->endColumn = $endColumn;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $overlap = DB::table($this->table)
            ->where(function ($query) {
                $query->whereBetween($this->startColumn, [$this->startDate, $this->endDate])
                    ->orWhereBetween($this->endColumn, [$this->startDate, $this->endDate]);
            })
            ->exists();

        if ($overlap) {
            $fail(trans('validation.custom.date_range_overlap', ['table' => $this->table]));
        }
    }
}
