<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\ProgressData;
use App\Http\Requests\Student\ScoreData;
use App\Http\Requests\StudentProfile;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use App\Rules\SectionAssign;
use App\Rules\StudentAssign;
use App\Services\SectionService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentApiController extends Controller
{

    protected $sectionService;
    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(
            Student::with('section')->paginate(20)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentProfile $request)
    {
        // $request->validate();

        DB::beginTransaction();

        try {

            # Step 1: Create a user account:

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => User::ROLES['2']
            ]);

            # Step 2: Create a student info:

            $student = new Student([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'middlename' => $request->middlename
            ]);

            # Step 3: Assign a user account to a created student info:

            $student->assign_user($user);

            # Step 4: Save student info:

            $student->save();


            DB::commit();

            return response()->json([
                'message' => 'Student Profile Created!',
                'data' => $student
            ], 200);

        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Something wrong on the server or on your side...',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json(
            $student->with(['section', 'user'])->get()
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $updated = $request->user()->student->update([
            'firstname' => $request->firstname ?? $request->user()->student->firstname,
            'lastname' => $request->lastname ?? $request->user()->student->lastname,
            'middlename' => $request->middlename ?? $request->user()->student->middlename
        ]);

        if($updated)
        {
            return response()->json([
                'message' => 'Student Score Updated!',
                'data' => $request->user()->student
            ]);
        }

        return response()->json([
            'message' => 'Invalid request body!'
        ],400);
    }

    public function update_score(ScoreData $request)
    {
        // $request->validate();

        $updated = $request->user()->student->update([
            'pre_test_score' => $request->pre_test_score ?? $request->user()->student->pre_test_score,
            'post_test_score' => $request->post_test_score ?? $request->user()->student->post_test_score
        ]);

        if($updated)
        {
            return response()->json([
                'message' => 'Student Score Updated!',
                'data' => $request->user()->student
            ]);
        }

        return response()->json([
            'message' => 'Invalid request body!'
        ],400);
    }

    public function update_progress(ProgressData $request)
    {
        // $request->validate();

        $updated = $request->user()->student->update([
            'tera_mastery' => $request->tera_mastery ?? $request->user()->student->tera_mastery,
            'momentum_mastery' => $request->momentum_mastery ?? $request->user()->student->momentum_mastery,
            'ecology_mastery' => $request->ecology_mastery ?? $request->user()->student->ecology_mastery,
            'quantum_mastery' => $request->quantum_mastery ?? $request->user()->student->quantum_mastery
        ]);

        if($updated)
        {
            return response()->json([
                'message' => 'Student Progress Updated!',
                'data' => $request->user()->student
            ]);
        }

        return response()->json([
            'message' => 'Invalid request body!'
        ],400);
    }

    public function update_aspiration(Request $request)
    {
        $updated = $request->user()->section->update([
            'aspiration' => $request->aspiration
        ]);

        if($updated)
        {
            return response()->json([
                'message' => 'Student Aspiration Updated!',
                'data' => $request->user()->student
            ]);
        }

        return response()->json([
            'message' => 'Invalid request body!'
        ],400);
    }

    public function assign(Request $request)
    {
        $request->validate([
            'section_id' => ['numeric', new SectionAssign()],
            'student_id' => ['numeric', new StudentAssign()]
        ]);

        $section = Section::find($request->section_id);
        $student = Student::find($request->student_id);

        $this->sectionService->assign_student(
                    $section,
                    $student);

        return response()->json([
            'message' => 'Student Assigned!',
            'data' => $student->with('section')->get()
        ]);
    }

    public function assign_self(Request $request, Section $section)
    {
        $student = $request->user()->student;

        $student->assign_section($section);

        return response()->json([
            'message' => 'Student Assigned!',
            'data' => $student->with('section')->get()
        ]);
    }
}
