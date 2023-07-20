<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\API\v1\OrangTua\PostOrangTuaRequest;
use App\Http\Requests\API\v1\OrangTua\UpdateOrangTuaRequest;

class OrangTuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = [
            'gender' => $request->input('gender'),
            'status' => $request->input('status'),
            'search' => $request->input('search'),
        ];

        $perPage = 10; // Set your desired number of results per page.

        $orangTuaQuery = OrangTua::with('siswa')
            ->when($filters['gender'], fn ($query, $gender) => $query->filterByGender($gender))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->when($filters['search'], fn ($query, $search) => $query->search($search));

        $orangTua = $orangTuaQuery->paginate($perPage);

        if ($orangTua->isEmpty()) {
            return response()->api(null, 'Tidak ada data orang tua', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($orangTua, 'Berhasil mendapatkan data orang tua', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostOrangTuaRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 3,
        ]);

        $orangTua = OrangTua::create([
            'nama' => $validatedData['nama'],
            'no_wa' => $validatedData['no_wa'],
            'gender' => $validatedData['gender'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'alamat' => $validatedData['alamat'],
            'status' => $validatedData['status'],
            'user_id' => $user->id,
        ]);

        return response()->api($orangTua, 'Berhasil menambahkan data orang tua', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $orangTuaId)
    {
        $orangTua = OrangTua::find($orangTuaId);
        if (!$orangTua) {
            return response()->api(null, 'Orang tua tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($orangTua, 'Berhasil mendapatkan data orang tua', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrangTuaRequest $request, string $orangTuaId)
    {
        $validatedData = $request->validated();

        $orangTua = OrangTua::find($orangTuaId);

        if (!$orangTua) {
            return response()->api(null, 'Orang tua tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        $orangTua->update([
            'nama' => $validatedData['nama'],
            'no_wa' => $validatedData['no_wa'],
            'gender' => $validatedData['gender'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'alamat' => $validatedData['alamat'],
            'status' => $validatedData['status'],
        ]);

        return response()->api($orangTua, 'Orang tua berhasil diupdate', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deactivate(string $orangTuaId)
    {
        $orangTua = OrangTua::find($orangTuaId);
        if (!$orangTua) {
            return response()->api(null, 'Orang tua tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        $orangTua->user->update([
            'status' => 'D',
        ]);

        return response()->api(null, 'Orang tua berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}