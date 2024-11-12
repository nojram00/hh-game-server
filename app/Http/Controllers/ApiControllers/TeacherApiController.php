<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherApiController extends Controller
{
    public function index()
    {
        $teachers = Teacher::paginate(3);

        return response()->json($teachers);
    }
}
