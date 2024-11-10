<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\ProgressData;
use App\Http\Requests\Student\ScoreData;
use App\Http\Requests\StudentProfile;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentApiController extends Controller
{
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
        $request->validate();

        DB::beginTransaction();

        try {

            # Step 1: Create a user account:

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
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
            $student->with(['section', 'user'])
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    public function update_score(ScoreData $request, Student $student)
    {
        $request->validate();

        $updated = $student->update([
            'pre_test_score' => $request->pre_test_score != null ? $request->pre_test_score : $student->pre_test_score,
            'post_test_score' => $request->post_test_score != null ? $request->post_test_score : $student->post_test_score
        ]);

        if($updated)
        {
            return response()->json([
                'message' => 'Student Score Updated!',
                'data' => $student
            ]);
        }

        return response()->json([
            'message' => 'Invalid request body!'
        ],400);
    }

    public function update_progress(ProgressData $request, Student $student)
    {
        $request->validate();

        $updated = $student->update([
            'tera_mastery' => $request->tera_mastery != null ? $request->tera_mastery : $student->tera_mastery,
            'momentum_mastery' => $request->momentum_mastery != null ? $request->momentum_mastery : $student->momentum_mastery,
            'ecology_mastery' => $request->ecology_mastery != null ? $request->ecology_mastery : $student->ecology_mastery,
            'quantum_mastery' => $request->quantum_mastery != null ? $request->quantum_mastery : $student->quantum_mastery
        ]);

        if($updated)
        {
            return response()->json([
                'message' => 'Student Progress Updated!',
                'data' => $student
            ]);
        }

        return response()->json([
            'message' => 'Invalid request body!'
        ],400);
    }

    public function assign(Request $request)
    {
        $request->validate([
            'section_id' => ['numeric']
        ]);
    }
}
