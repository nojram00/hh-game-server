<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class ProgressData extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tera_mastery' => 'numeric|nullable',
            'momentum_mastery' => 'numeric|nullable',
            'ecology_mastery' => 'numeric|nullable',
            'quantum_mastery' => 'numeric|nullable'
        ];
    }
}
