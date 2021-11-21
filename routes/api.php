<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ImageController;
use App\Http\Controllers\Api\V1\PermissionController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\UserController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::put('/user/profile', [AuthController::class, 'updateInfo']);
    Route::put('/user/password', [AuthController::class, 'updatePassword']);

    Route::apiResource('/users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::get('/permissions', [PermissionController::class, 'index']);
    Route::apiResource('/products', ProductController::class);

    Route::post('/images', [ImageController::class, 'upload']);
});
