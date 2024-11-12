<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherForm;
use App\Models\Teacher;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
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

    public function add()
    {
        return Inertia::render('Teacher/Create');
    }

    public function create_user(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', Password::defaults()],
        ]);

        $existed = User::where('email', '=', $request->email)
                        ->where('name', '=', $request->name)
                        ->get();

        if($existed->isNotEmpty())
        {
            return Redirect::route('create-teacher.get', $existed->first()->id);
        }

        DB::beginTransaction();

        try
        {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            return Redirect::route('create-teacher.get', $user->id);

        }
        catch (Exception $e)
        {
            DB::rollBack();
            Log::info($e);
            abort(500);
        }
    }

    public function create_teacher_view(User $user)
    {
        return Inertia::render('Teacher/CreateTeacher', [
            'user' => $user
        ]);
    }

    public function create_teacher(Request $request, User $user)
    {
        if($user == null)
        {
            return Redirect::route('create-teacher.get');
        }

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'middlename' => 'nullable'
        ]);

        DB::beginTransaction();
        try
        {
            $teacher = new Teacher([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'middlename' => $request->middlename,
            ]);

            $teacher->assign_user($user);

            $teacher->save();

            DB::commit();

            return Redirect::route('teachers');
        }
        catch (Exception $e)
        {
            DB::rollBack();

            Log::info($e);

            $user->delete();

            abort(500);
        }
    }
}
