<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Redirect::route('login');
});

Route::get('/devs/docs', function(){
    return Inertia::render('Docs', [
        'api_url' => url('/')
    ]);
})->name('api-docs');

Route::get('/test-error-page',function(){
    return Inertia::render('Errors/ErrorPage', [
        'code' => 200,
        'error' => 'Ok',
        'message' => 'Testing Onleh!'
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'student_count' => Student::count(),
        'teacher_count' => Teacher::count(),
        'section_count' => Section::count()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::controller(StudentController::class)->group(function(){
        Route::get('/students', 'student_view')->name('students');
        Route::get('/student/{student}', 'info')->name('student');
    });

    Route::controller(SectionController::class)->group(function(){
        Route::get('/sections', 'index')->name('sections');
        Route::get('/section/{section}', 'info')->name('section');
    });

    Route::controller(TeacherController::class)->group(function(){
        Route::get('/teachers', 'index')->name('teachers');
        Route::get('/create-user', 'add')->name('create-user.get');
        Route::get('/create-teacher/{user}','create_teacher_view')->name('create-teacher.get');
        Route::post('/create-user', 'create_user')->name('create-user.post');
        Route::post('/create-teacher/{user}', 'create_teacher')->name('create-teacher.post');
    });

});


require __DIR__.'/auth.php';
