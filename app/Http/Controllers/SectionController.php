<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Models\Section;
use App\Models\Teacher;
use App\Services\SectionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
            'section_name' => $section_name,
            'section_id' => $section->id
        ]);
    }

    public function create_view(Request $request)
    {
        $teacher_list = Teacher::paginate(3);

        if($request->wantsJson())
        {
            return response()->json($teacher_list);
        }

        return Inertia::render('Section/Create',[
            'teachers' => $teacher_list,
            'production_mode' => App::environment('production')
        ]);
    }

    public function create(SectionRequest $request)
    {
        DB::beginTransaction();

        try
        {
            $section = new Section([
                'section_name' => $request->section_name
            ]);


            if($request->get_teacher() != null)
            {
                $section->assign_teacher($request->get_teacher());
            }

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

    public function edit(Section $section, Request $request)
    {
        $teacher_list = Teacher::paginate(3);

        if($request->wantsJson())
        {
            return response()->json($teacher_list);
        }

        return Inertia::render('Section/Edit',[
            'section' => $section,
            'teachers' => $teacher_list,
            'production_mode' => App::environment('production')
        ]);
    }

    public function update(Section $section, SectionRequest $request)
    {
        try
        {
            $section->update([
                'section_name' => $request->section_name
            ]);

            if($request->get_teacher())
            {
                $section->assign_teacher($request->get_teacher());

                $section->save();
            }

            return Redirect::route('edit-section.get');
        }
        catch (Throwable $e)
        {
            return redirect()->route('section', $section->id);
        }
    }

    public function get_teacher_section(Request $request)
    {

        $teacher = $request->user()->teacher;
        $section = $request->user()->teacher->section;

        // return \response()->json($section->students()->paginate(20));
        if($section != null && $section->students != null)
        {
            $students = $section->students()->paginate(20);

            return Inertia::render('MySection', [
                'section' => $section,
                'students' => $students ?? null,
                'teacher' => $teacher
            ]);

            // try
            // {

            //     $students = $section->students->paginate(20);

            //     return Inertia::render('MySection', [
            //         'section' => $section,
            //         'students' => $students ?? null,
            //         'teacher' => $teacher
            //     ]);
            // }
            // catch(Exception $e)
            // {
            //     return Inertia::render('MySection', [
            //         'section' => null,
            //         'students' => $students ?? null,
            //         'teacher' => $teacher
            //     ]);
            // }
        }

        return Inertia::render('MySection', [
            'section' => $section,
            'students' => $students ?? null,
            'teacher' => $teacher
        ]);
    }
}
