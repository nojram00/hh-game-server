<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TeacherController extends Controller
{

    public function index()
    {
        $teachers = Teacher::paginate(20);

        return Inertia::render('Teachers', [
            'teachers' => $teachers
        ]);
    }
}
