<?php

namespace App\Http\Requests;

use App\Models\Teacher;
use App\Models\User;
use App\Rules\TeacherInstance;
use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->role == User::ROLES['0'];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'section_name' => 'required|string',
            'teacher_id' => ['numeric', 'nullable', new TeacherInstance()]
        ];
    }

    public function get_teacher() : Teacher | null {

        if($this->has('teacher_id'))
        {
            return Teacher::find($this->teacher_id);
        }

        return null;
    }
}
