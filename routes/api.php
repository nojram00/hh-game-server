<?php

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

Route::controller(StudentApiController::class)->group(function(){
    Route::get('/students', 'index');
    Route::get('/student/find/{student}', 'show');
    Route::post('/student/create', 'store');
    Route::patch('student/update/score', 'update_score');
    Route::patch('/student/update/progress', 'update_progress');
});

Route::controller(UserApiController::class)->group(function(){

});
