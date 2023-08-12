<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\GuruController;
use App\Http\Controllers\API\v1\RoleController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\AdminController;
use App\Http\Controllers\API\v1\RuangController;
use App\Http\Controllers\API\v1\SiswaController;
use App\Http\Controllers\API\v1\DiskonController;
use App\Http\Controllers\API\v1\OrangTuaController;
use App\Http\Controllers\API\v1\KurikulumController;
use App\Http\Controllers\API\v1\JabatanGuruController;
use App\Http\Controllers\API\v1\BiayaSekolahController;
use App\Http\Controllers\API\v1\KategoriHariController;
use App\Http\Controllers\API\v1\KategoriWaktuController;
use App\Http\Controllers\API\v1\MataPelajaranController;
use App\Http\Controllers\API\v1\KategoriKegiatanController;
use App\Http\Controllers\API\v1\JenisTingkatLombaController;

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
// Route for user controller
Route::middleware('jwt.role:Admin')->prefix('v1/user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{user}', [UserController::class, 'show']);
    Route::put('/{user}', [UserController::class, 'update']);
    Route::delete('/{user}', [UserController::class, 'deactivate']);
});

// Route for role controller
Route::middleware('jwt.role:Admin')->prefix('v1/role')->group(function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::get('/{role}', [RoleController::class, 'show']);
    Route::post('/', [RoleController::class, 'store']);
    Route::put('/{role}', [RoleController::class, 'update']);
    Route::delete('/{role}', [RoleController::class, 'deactivate']);
});

// Route for admin controller
Route::middleware('jwt.role:Admin')->prefix('v1/admin')->group(function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/{admin}', [AdminController::class, 'show']);
    Route::post('/', [AdminController::class, 'store']);
    Route::put('/{admin}', [AdminController::class, 'update']);
    Route::delete('/{admin}', [AdminController::class, 'deactivate']);
});

// Route for siswa controller
Route::middleware('jwt.role:Admin')->prefix('v1/siswa')->group(function () {
    Route::get('/', [SiswaController::class, 'index']);
    Route::get('/{siswa}', [SiswaController::class, 'show']);
    Route::post('/', [SiswaController::class, 'store']);
    Route::put('/{siswa}', [SiswaController::class, 'update']);
    Route::delete('/{siswa}', [SiswaController::class, 'deactivate']);
});

// Route for guru controller
Route::middleware('jwt.role:Admin')->prefix('v1/guru')->group(function () {
    Route::get('/', [GuruController::class, 'index']);
    Route::get('/{guru}', [GuruController::class, 'show']);
    Route::post('/', [GuruController::class, 'store']);
    Route::put('/{guru}', [GuruController::class, 'update']);
    Route::delete('/{guru}', [GuruController::class, 'deactivate']);
});

// Route for orang tua controller
Route::middleware('jwt.role:Admin')->prefix('v1/orang-tua')->group(function () {
    Route::get('/', [OrangTuaController::class, 'index']);
    Route::get('/{orangTua}', [OrangTuaController::class, 'show']);
    Route::post('/', [OrangTuaController::class, 'store']);
    Route::put('/{orangTua}', [OrangTuaController::class, 'update']);
    Route::delete('/{orangTua}', [OrangTuaController::class, 'deactivate']);
});

// Route for ruang controller
Route::middleware('jwt.role:Admin')->prefix('v1/ruang')->group(function () {
    Route::get('/', [RuangController::class, 'index']);
    Route::get('/{ruang}', [RuangController::class, 'show']);
    Route::post('/', [RuangController::class, 'store']);
    Route::put('/{ruang}', [RuangController::class, 'update']);
    Route::delete('/{ruang}', [RuangController::class, 'deactivate']);
});

// Route for mata pelajaran controller
Route::middleware('jwt.role:Admin')->prefix('v1/mata-pelajaran')->group(function () {
    Route::get('/', [MataPelajaranController::class, 'index']);
    Route::get('/{mataPelajaran}', [MataPelajaranController::class, 'show']);
    Route::post('/', [MataPelajaranController::class, 'store']);
    Route::put('/{mataPelajaran}', [MataPelajaranController::class, 'update']);
    Route::delete('/{mataPelajaran}', [MataPelajaranController::class, 'deactivate']);
});

// Route for jenis tingkat lomba controller
Route::middleware('jwt.role:Admin')->prefix('v1/jenis-tingkat-lomba')->group(function () {
    Route::get('/', [JenisTingkatLombaController::class, 'index']);
    Route::get('/{jenisTingkatLomba}', [JenisTingkatLombaController::class, 'show']);
    Route::post('/', [JenisTingkatLombaController::class, 'store']);
    Route::put('/{jenisTingkatLomba}', [JenisTingkatLombaController::class, 'update']);
    Route::delete('/{jenisTingkatLomba}', [JenisTingkatLombaController::class, 'deactivate']);
});

// Route for kategori kegiatan controller
Route::middleware('jwt.role:Admin')->prefix('v1/kategori-kegiatan')->group(function () {
    Route::get('/', [KategoriKegiatanController::class, 'index']);
    Route::get('/{kategoriKegiatan}', [KategoriKegiatanController::class, 'show']);
    Route::post('/', [KategoriKegiatanController::class, 'store']);
    Route::put('/{kategoriKegiatan}', [KategoriKegiatanController::class, 'update']);
    Route::delete('/{kategoriKegiatan}', [KategoriKegiatanController::class, 'deactivate']);
});

// Route for jabatan guru controller
Route::middleware('jwt.role:Admin')->prefix('v1/jabatan-guru')->group(function () {
    Route::get('/', [JabatanGuruController::class, 'index']);
    Route::get('/{jabatanGuru}', [JabatanGuruController::class, 'show']);
    Route::post('/', [JabatanGuruController::class, 'store']);
    Route::put('/{jabatanGuru}', [JabatanGuruController::class, 'update']);
    Route::delete('/{jabatanGuru}', [JabatanGuruController::class, 'deactivate']);
});

// Route for diskon controller
Route::middleware('jwt.role:Admin')->prefix('v1/diskon')->group(function () {
    Route::get('/', [DiskonController::class, 'index']);
    Route::get('/{diskon}', [DiskonController::class, 'show']);
    Route::post('/', [DiskonController::class, 'store']);
    Route::put('/{diskon}', [DiskonController::class, 'update']);
    Route::delete('/{diskon}', [DiskonController::class, 'deactivate']);
});

// Route for biaya sekolah controller
Route::middleware('jwt.role:Admin')->prefix('v1/biaya-sekolah')->group(function () {
    Route::get('/', [BiayaSekolahController::class, 'index']);
    Route::get('/{biayaSekolah}', [BiayaSekolahController::class, 'show']);
    Route::post('/', [BiayaSekolahController::class, 'store']);
    Route::put('/{biayaSekolah}', [BiayaSekolahController::class, 'update']);
    Route::delete('/{biayaSekolah}', [BiayaSekolahController::class, 'deactivate']);
});

// Route for kategori hari controller
Route::middleware('jwt.role:Admin')->prefix('v1/kategori-hari')->group(function () {
    Route::get('/', [KategoriHariController::class, 'index']);
    Route::get('/{kategoriHari}', [KategoriHariController::class, 'show']);
    Route::post('/', [KategoriHariController::class, 'store']);
    Route::put('/{kategoriHari}', [KategoriHariController::class, 'update']);
    Route::delete('/{kategoriHari}', [KategoriHariController::class, 'deactivate']);
});

// Route for kategori waktu controller
Route::middleware('jwt.role:Admin')->prefix('v1/kategori-waktu')->group(function () {
    Route::get('/', [KategoriWaktuController::class, 'index']);
    Route::get('/{kategoriWaktu}', [KategoriWaktuController::class, 'show']);
    Route::post('/', [KategoriWaktuController::class, 'store']);
    Route::put('/{kategoriWaktu}', [KategoriWaktuController::class, 'update']);
    Route::delete('/{kategoriWaktu}', [KategoriWaktuController::class, 'deactivate']);
});

// Route for kurikulum controller
Route::middleware('jwt.role:Admin')->prefix('v1/kurikulum')->group(function () {
    Route::get('/', [KurikulumController::class, 'index']);
    Route::get('/{kurikulum}', [KurikulumController::class, 'show']);
    Route::post('/', [KurikulumController::class, 'store']);
    Route::put('/{kurikulum}', [KurikulumController::class, 'update']);
    Route::delete('/{kurikulum}', [KurikulumController::class, 'deactivate']);
});
