<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSection;
use App\Models\Section;
use App\Models\Teacher;
use App\Services\SectionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Throwable;

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

    public function create_view(Request $request)
    {
        $teacher_list = Teacher::paginate(20);

        if($request->wantsJson())
        {
            return response()->json($teacher_list);
        }

        return Inertia::render('Section/Create',[
            'teachers' => $teacher_list
        ]);
    }

    public function create(AddSection $request)
    {
        DB::beginTransaction();

        try
        {
            $section = new Section([
                'section_name' => $request->section_name
            ]);

            $section->assign_teacher($request->get_teacher());

            $section->save();

            DB::commit();

            return Redirect::route('create-section.get')->with('message','Section added.');

        }
        catch(Throwable $e)
        {
            DB::rollBack();

            dd($e);

            return Redirect::route('sections')->with('error', 'Section Failed to add');
        }

    }
}
