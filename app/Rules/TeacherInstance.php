<?php

namespace App\Rules;

use App\Models\Teacher;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TeacherInstance implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(Teacher::find($value) == null)
        {
            $fail("Teacher id $value is not found...");
        }
    }
}
