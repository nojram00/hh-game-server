<?php

namespace App\Services;

use App\Models\Section;
use App\Models\Student;

class StudentService
{
    public function create_student($firstname, $lastname, $middlename = null)
    {
        $student = new Student([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'middlename' => $middlename
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
}
