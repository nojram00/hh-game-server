<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentFilter;
use App\Models\Student;
use App\Models\User;
use App\Services\StudentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class StudentController extends Controller
{
    protected $studentService;
    public function __construct(StudentService $service)
    {
        $this->studentService = $service;
    }

    public function student_view(StudentFilter $request)
    {
        $students = $request->sort_by();

        return Inertia::render('Students', [
            'students' => $students
        ]);
    }

    public function info(Student $student)
    {
        return Inertia::render('Student/Info',[
            'student' => $student
        ]);
    }

    public function add_student_view() : InertiaResponse
    {
        return Inertia::render(['AddStudent']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Password::defaults()],
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'middlename' => 'string|max:255',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $this->studentService
            ->create_student(
                $request->firstname,
                $request->lastname,
                $request->middlename
            )
            ->assign_user($user)
            ->save();
    }

}
