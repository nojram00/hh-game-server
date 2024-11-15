<?php

namespace App\Services;

use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;

class SectionService
{
    public function create_section($section_name)
    {
        $section = new Section([
            'section_name' => $section_name
        ]);

        $section->save();

        return $section;
    }
    public function assign_teacher(Section $section, Teacher $teacher)
    {
        return $section
                ->assign_teacher($teacher)
                ->save();
    }

    public function assign_student(Section $section, Student $student)
    {
        return $student->assign_section($section)->save();
    }
}
