<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionApiController extends Controller
{
    public function index()
    {
        $sections = Section::paginate(20);

        return response()->json($sections);
    }
}
