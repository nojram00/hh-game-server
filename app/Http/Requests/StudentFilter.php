<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;

class StudentFilter extends FormRequest
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
            //
        ];
    }

    public function sort_by()
    {
        $student = Student::query();

        if($this->has('filter'))
        {
            switch($this->filter)
            {
                case 'pre_test':
                    $student = $student->orderBy('pre_test_score', 'desc');
                    break;
                case 'post_test':
                    $student = $student->orderBy('post_test_score', 'desc');
                    break;
                case 'qm':
                    $student = $student->orderBy('quantum_mastery', 'desc');
                    break;
                case 'em':
                    $student = $student->orderBy('ecology_mastery', 'desc');
                    break;
                case 'tm':
                    $student = $student->orderBy('tera_mastery', 'desc');
                    break;
                case 'mm':
                    $student = $student->orderBy('momentum_mastery', 'desc');
                    break;
                default:
                    break;
            }
        }


        return $student->paginate(20);
    }
}
