<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTeacherForm;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Throwable;

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

    public function create_teacher_view(User $user, Request $request)
    {

        $sections = Section::simplePaginate(3);

        if($request->wantsJson())
        {
            return response()->json($sections);
        }

        return Inertia::render('Teacher/CreateTeacher', [
            'user' => $user,
            'sections' => $sections,
            'in_production' => App::environment('production')
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

    public function setup_teacher_profile(Request $request)
    {
        if($request->user()->teacher != null)
        {
            return redirect()->route('my-section');
        }

        return Inertia::render('Setup');
    }

    public function complete_setup(Request $request)
    {

        // $request->validate([
        //     'firstname' => 'required|string|max:255',
        //     'lastname' => 'required|string|max:255'
        // ]);

        DB::beginTransaction();

        try
        {
            $teacher = new Teacher([
                'firstname' => $request->firstname,
                'middlename' => $request->middlename ?? "",
                'lastname' => $request->lastname
            ]);

            $teacher->assign_user($request->user());

            $teacher->save();

            DB::commit();

            return Redirect::route('my-section');
        }
        catch(Throwable $e)
        {

            DB::rollBack();

            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }
    }
}
