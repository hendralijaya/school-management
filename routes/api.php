<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\GuruController;
use App\Http\Controllers\API\v1\RoleController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\SiswaController;
use App\Http\Controllers\API\v1\OrangTuaController;

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

// Authentication routes (No jwt.role middleware)
Route::prefix('v1/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/test', [AuthController::class, 'test']);
});

// Routes that require role-based authorization
Route::middleware('jwt.role:Admin')->prefix('v1/user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{userId}', [UserController::class, 'show']);
    Route::put('/{userId}', [UserController::class, 'update']);
    Route::delete('/{userId}', [UserController::class, 'deactivate']);
});

Route::middleware('jwt.role:Admin')->prefix('v1/role')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::get('/{roleId}', [RoleController::class, 'show']);
    Route::post('/', [RoleController::class, 'store']);
    Route::put('/{roleId}', [RoleController::class, 'update']);
    Route::delete('/{roleId}', [RoleController::class, 'deactivate']);
});

Route::middleware('jwt.role:Admin')->prefix('v1/siswa')->group(function () {
    Route::get('/', [SiswaController::class, 'index']);
    Route::get('/{siswaId}', [SiswaController::class, 'show']);
    Route::post('/', [SiswaController::class, 'store']);
    Route::put('/{siswaId}', [SiswaController::class, 'update']);
    Route::delete('/{siswaId}', [SiswaController::class, 'deactivate']);
});

Route::middleware('jwt.role:Admin')->prefix('v1/guru')->group(function () {
    Route::get('/', [GuruController::class, 'index']);
    Route::get('/{guruId}', [GuruController::class, 'show']);
    Route::post('/', [GuruController::class, 'store']);
    Route::put('/{guruId}', [GuruController::class, 'update']);
    Route::delete('/{guruId}', [GuruController::class, 'deactivate']);
});

Route::middleware('jwt.role:Admin')->prefix('v1/orang-tua')->group(function () {
    Route::get('/', [OrangTuaController::class, 'index']);
    Route::get('/{orangTuaId}', [OrangTuaController::class, 'show']);
    Route::post('/', [OrangTuaController::class, 'store']);
    Route::put('/{orangTuaId}', [OrangTuaController::class, 'update']);
    Route::delete('/{orangTuaId}', [OrangTuaController::class, 'deactivate']);
});
