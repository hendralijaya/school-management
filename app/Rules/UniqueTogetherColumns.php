<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueTogetherColumns implements ValidationRule
{
    private $table;
    private $columns;
    private $ignoreId;
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function __construct(string $table, array $columns, int $ignoredId = null)
    {
        $this->table = $table;
        $this->columns = $columns;
        $this->ignoreId = $ignoredId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = DB::table($this->table);

        foreach ($this->columns as $column => $columnValue) {
            $query->where($column, $columnValue);
        }

        if ($this->ignoreId !== null) {
            $query->where('id', '<>', $this->ignoreId);
        }

        if ($query->count() > 0) {
            $columns = implode(', ', array_keys($this->columns));
            $fail("The combination of {$columns} columns already exists.");
        }
    }
}
