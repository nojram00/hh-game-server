<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StudentProfile extends FormRequest
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
            'name' => 'string|required|max:255',
            'email' => 'string|email|required|max:255',
            'password' => ['required|alpha_num', Password::defaults()],
            'firstname' => 'string|required|max:255',
            'lastname' => 'string|required|max:255',
            'middlename' => 'nullable'
        ];
    }
}
