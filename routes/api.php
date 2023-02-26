<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(ProjectController::class)->prefix('projects')->group(function () {
    Route::post('create', 'store');
    Route::put('/{projectId}', 'update');
    Route::patch('/{projectId}', 'update');
    Route::delete('/{projectId}', 'destroy');
    Route::get('restore/{projectId}', 'restore');
    Route::post('{projectId}/members/add', 'addMembers');
    Route::post('{projectId}/members/remove', 'removeMembers');
    Route::get('/', 'getAll');
    Route::get('/paginate/{perPage}', 'paginate');
});

Route::controller(TaskController::class)->prefix('tasks')->group(function () {
    Route::post('create', 'store');
    Route::get('/{taskId}', 'show');
    Route::put('/{taskId}', 'update');
    Route::patch('/{taskId}', 'update');
    Route::delete('/{taskId}', 'destroy');
    Route::get('restore/{taskId}', 'restore');
    Route::get('/', 'getAll');
    Route::get('/paginate/{perPage}', 'paginate');
    Route::get('/status/{status}','getTaskByStatus');
});
