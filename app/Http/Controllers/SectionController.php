<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Services\SectionService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SectionController extends Controller
{
    protected $sectionService;
    public function __construct(SectionService $service)
    {
        $this->sectionService = $service;
    }

    public function index()
    {
        $sections = Section::withCount('students')->paginate(20);

        return Inertia::render('Sections', [
            'sections' => $sections
        ]);
    }

    public function info(Section $section)
    {
        $students = $section->students()->paginate(20);
        $teacher = $section->teacher_name;
        $section_name = $section->section_name;

        return Inertia::render('Section/Info', [
            'students' => $students,
            'teacher' => $teacher,
            'section_name' => $section_name
        ]);
    }
}
