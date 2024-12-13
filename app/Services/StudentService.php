<?php

namespace App\Services;

use App\Models\Section;
use App\Models\Student;

class StudentService
{
    public function create_student($firstname, $lastname, $middlename = null, $section_id = null)
    {
        $student = new Student([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'middlename' => $middlename,
            'section_id' => $section_id
        ]);

        $student->save();

        return $student;
    }

    public function assign_section(Student $student, Section $section)
    {
        $assigned = $student->assign_section($section);

        $assigned->save();

        return $assigned;
    }

    public function get_students_from_section(Section $section)
    {
        return $section->students()->paginate(20);
    }
}
