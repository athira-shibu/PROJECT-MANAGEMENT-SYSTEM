<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Project\ProjectCreateController;
use App\Http\Controllers\Project\ProjectDeleteController;
use App\Http\Controllers\Project\ProjectUpdateController;
use App\Http\Controllers\Task\TaskCreateController;
use App\Http\Controllers\Task\TaskUpdateController;
use App\Http\Controllers\User\TaskReportController;
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
    Route::post('/logout', [LogoutController::class, 'logout']);
    return $request->user();
});

Route::middleware('auth:api')->post('/logout', [LogoutController::class, 'logout']);

Route::group([
    'prefix' => 'projects',
    'as' => 'projects.',
    ], static function () {
        Route::post('/', [ProjectCreateController::class, 'create']);
        Route::put('/{id}', [ProjectUpdateController::class, 'update']);
        Route::delete('/{id}', [ProjectDeleteController::class, 'delete']);
    }
);

Route::post('/tasks', [TaskCreateController::class, 'create']);
Route::put('/tasks/{id}', [TaskUpdateController::class, 'update']);

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/reports/{userId}', [TaskReportController::class, 'get']);


