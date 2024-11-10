<?php

use App\Http\Controllers\ApiControllers\SectionApiController;
use App\Http\Controllers\ApiControllers\StudentApiController;
use App\Http\Controllers\ApiControllers\UserApiController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
return $request->user();
});

Route::prefix('/v1')->group(function(){

    Route::controller(StudentApiController::class)->group(function(){
        Route::get('/students', 'index');
        Route::get('/student/find/{student}', 'show');
        Route::post('/student/create', 'store');
        Route::post('/student/assign-section', 'assign');

        Route::middleware('auth:sanctum')->group(function(){
            Route::patch('/student/update/score', 'update_score');
            Route::patch('/student/update/progress', 'update_progress');
            Route::patch('/student/me/assign-section/{section}', 'assign_self');
        });
    });

    Route::controller(UserApiController::class)->group(function(){
        Route::post('/auth', 'generate_token');

        Route::middleware('auth:sanctum')->group(function(){
            Route::get('/student-info', 'get_student_info');
        });
    });

    Route::controller(SectionApiController::class)->group(function(){
        Route::get('/sections', 'index');
    });

})->name('api-v1');




