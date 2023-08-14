<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckRelatedStatus implements ValidationRule
{
    protected $modelClass;
    protected $statusField;

    public function __construct(string $modelClass, string $statusField = 'status')
    {
        $this->modelClass = $modelClass;
        $this->statusField = $statusField;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $model = call_user_func([$this->modelClass, 'find'], $value);

        if ($model && $model->{$this->statusField} === 'D') {
            $fail('validation.check_related_status', ['attribute' => class_basename($this->modelClass)]);
        }
    }
}
