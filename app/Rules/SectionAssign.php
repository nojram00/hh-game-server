<?php

namespace App\Rules;

use App\Models\Section;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SectionAssign implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $section = Section::find($value);
        if($section == null)
        {
            $fail("Please input a valid section id");
        }
    }
}
