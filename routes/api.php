<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\GuruController;
use App\Http\Controllers\API\v1\RoleController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\RuangController;
use App\Http\Controllers\API\v1\SiswaController;
use App\Http\Controllers\API\v1\OrangTuaController;
use App\Http\Controllers\API\v1\MataPelajaranController;

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
    // Protected routes (With jwt.role middleware)
    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    });
});

// Routes that require role-based authorization
Route::middleware('jwt.role:Admin')->prefix('v1/user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'deactivate']);
});

Route::middleware('jwt.role:Admin')->prefix('v1/role')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::get('/{role}', [RoleController::class, 'show']);
    Route::post('/', [RoleController::class, 'store']);
    Route::put('/{role}', [RoleController::class, 'update']);
    Route::delete('/{role}', [RoleController::class, 'deactivate']);
});

Route::middleware('jwt.role:Admin')->prefix('v1/siswa')->group(function () {
    Route::get('/', [SiswaController::class, 'index']);
    Route::get('/{siswa}', [SiswaController::class, 'show']);
    Route::post('/', [SiswaController::class, 'store']);
    Route::put('/{siswa}', [SiswaController::class, 'update']);
    Route::delete('/{siswa}', [SiswaController::class, 'deactivate']);
});

Route::middleware('jwt.role:Admin')->prefix('v1/guru')->group(function () {
    Route::get('/', [GuruController::class, 'index']);
    Route::get('/{guru}', [GuruController::class, 'show']);
    Route::post('/', [GuruController::class, 'store']);
    Route::put('/{guru}', [GuruController::class, 'update']);
    Route::delete('/{guru}', [GuruController::class, 'deactivate']);
});

Route::middleware('jwt.role:Admin')->prefix('v1/orang-tua')->group(function () {
    Route::get('/', [OrangTuaController::class, 'index']);
    Route::get('/{orangTua}', [OrangTuaController::class, 'show']);
    Route::post('/', [OrangTuaController::class, 'store']);
    Route::put('/{orangTua}', [OrangTuaController::class, 'update']);
    Route::delete('/{orangTua}', [OrangTuaController::class, 'deactivate']);
});

Route::middleware('jwt.role:Admin')->prefix('v1/ruang')->group(function () {
    Route::get('/', [RuangController::class, 'index']);
    Route::get('/{ruang}', [RuangController::class, 'show']);
    Route::post('/', [RuangController::class, 'store']);
    Route::put('/{ruang}', [RuangController::class, 'update']);
    Route::delete('/{ruang}', [RuangController::class, 'deactivate']);
});

Route::middleware('jwt.role:Admin')->prefix('v1/mata-pelajaran')->group(function () {
    Route::get('/', [MataPelajaranController::class, 'index']);
    Route::get('/{mataPelajaran}', [MataPelajaranController::class, 'show']);
    Route::post('/', [MataPelajaranController::class, 'store']);
    Route::put('/{mataPelajaran}', [MataPelajaranController::class, 'update']);
    Route::delete('/{mataPelajaran}', [MataPelajaranController::class, 'deactivate']);
});
