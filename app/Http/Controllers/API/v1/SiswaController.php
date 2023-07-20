<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\API\v1\Siswa\PostSiswaRequest;
use App\Http\Requests\API\v1\Siswa\UpdateSiswaRequest;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $filters = [
            'gender' => $request->input('gender'),
            'status' => $request->input('status'),
            'tgl_bergabung_from' => $request->input('tgl_bergabung_from'),
            'tgl_bergabung_to' => $request->input('tgl_bergabung_to'),
            'search' => $request->input('search'),
        ];

        $perPage = 10; // Set your desired number of results per page.

        $siswaQuery = Siswa::query()
            ->when($filters['gender'], fn ($query, $gender) => $query->filterByGender($gender))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->when(
                $filters['tgl_bergabung_from'] && $filters['tgl_bergabung_to'],
                fn ($query) => $query->filterByTanggalBergabung($filters['tgl_bergabung_from'], $filters['tgl_bergabung_to'])
            )
            ->when($filters['search'], fn ($query, $search) => $query->search($search));

        $siswa = $siswaQuery->paginate($perPage);

        if ($siswa->isEmpty()) {
            return response()->api(null, 'Tidak ada data siswa', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($siswa, 'Berhasil mendapatkan data siswa', null, Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PostSiswaRequest $request)
    {
        $validatedData = $request->validated();
        // seperate data siswa and data user
        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 3,
        ]);

        $siswa = Siswa::create([
            'nama' => $validatedData['nama'],
            'no_wa' => $validatedData['no_wa'],
            'gender' => $validatedData['gender'],
            'tgl_bergabung' => $validatedData['tgl_bergabung'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'alamat' => $validatedData['alamat'],
            'status' => $validatedData['status'],
            'orang_tua_id' => $validatedData['orang_tua_id'],
            'user_id' => $user->id,
        ]);

        return response()->api($siswa, 'Berhasil menambahkan data siswa', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $siswaId)
    {
        $siswa = Siswa::with('user')->find($siswaId);
        if (!$siswa) {
            return response()->api(null, 'Data siswa tidak ditemukan', 'Not Found', Response::HTTP_NOT_FOUND);
        }
        return response()->api($siswa, 'Berhasil mendapatkan data siswa', null, Response::HTTP_OK);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $siswaId)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, string $siswaId)
    {
        $validatedData = $request->validated();

        $siswa = Siswa::find($siswaId);
        if (!$siswa) {
            return response()->api(null, 'Data siswa tidak ditemukan', 'Not Found', Response::HTTP_NOT_FOUND);
        }

        $siswa->update([
            'nama' => $validatedData['nama'],
            'no_wa' => $validatedData['no_wa'],
            'gender' => $validatedData['gender'],
            'tgl_bergabung' => $validatedData['tgl_bergabung'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'alamat' => $validatedData['alamat'],
            'status' => $validatedData['status'],
        ]);

        return response()->api($siswa, 'Berhasil mengubah data siswa', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deactivate(string $siswaId)
    {
        $siswa = Siswa::find($siswaId);
        if (!$siswa) {
            return response()->api(null, 'Data siswa tidak ditemukan', 'Not Found', Response::HTTP_NOT_FOUND);
        }

        $siswa->update([
            'status' => 'D',
        ]);

        return response()->api($siswa, 'Berhasil menonaktifkan data siswa', null, Response::HTTP_OK);
    }
}
