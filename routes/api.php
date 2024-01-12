<?php

use App\Http\Controllers\V1\Auth\AuthController;
use App\Http\Controllers\V1\Task\TaskController;
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

Route::group(['prefix' => 'v1', 'namespace' => 'V1'], function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('validate-token', [AuthController::class, 'validateToken']);
        });
    });

    Route::resource('task', TaskController::class)->except([
        'edit', 'create'
    ]);

    Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
    });
});
