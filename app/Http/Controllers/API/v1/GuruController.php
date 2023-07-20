<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\API\v1\Guru\PostGuruRequest;
use App\Http\Requests\API\v1\Guru\UpdateGuruRequest;

class GuruController extends Controller
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

        $guruQuery = Guru::query()
            ->when($filters['gender'], fn ($query, $gender) => $query->filterByGender($gender))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->when(
                $filters['tgl_bergabung_from'] && $filters['tgl_bergabung_to'],
                fn ($query) => $query->filterByTanggalBergabung($filters['tgl_bergabung_from'], $filters['tgl_bergabung_to'])
            )
            ->when($filters['search'], fn ($query, $search) => $query->search($search));

        $guru = $guruQuery->paginate($perPage);

        if ($guru->isEmpty()) {
            return response()->api(null, 'Tidak ada data guru', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($guru, 'Berhasil mendapatkan data guru', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostGuruRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 3,
        ]);

        $guru = Guru::create([
            'nama' => $validatedData['nama'],
            'no_wa' => $validatedData['no_wa'],
            'gender' => $validatedData['gender'],
            'tgl_bergabung' => $validatedData['tgl_bergabung'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'alamat' => $validatedData['alamat'],
            'status' => $validatedData['status'],
            'user_id' => $user->id,
        ]);

        return response()->api($guru, 'Berhasil menambahkan data guru', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $guruId)
    {
        $guru = Guru::find($guruId);

        if (!$guru) {
            return response()->api(null, 'Guru tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($guru, 'Berhasil mendapatkan data guru', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuruRequest $request, string $guruId)
    {
        $validatedData = $request->validated();

        $guru = Guru::find($guruId);
        if (!$guru) {
            return response()->api(null, 'Guru tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        $guru->update([
            'nama' => $validatedData['nama'],
            'no_wa' => $validatedData['no_wa'],
            'gender' => $validatedData['gender'],
            'tgl_bergabung' => $validatedData['tgl_bergabung'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'alamat' => $validatedData['alamat'],
            'status' => $validatedData['status'],
        ]);

        return response()->api($guru, 'Berhasil mengubah data guru', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deactivate(string $guruId)
    {
        $guru = Guru::find($guruId);

        if (!$guru) {
            return response()->api(null, 'Guru tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        $guru->update([
            'status' => 'D',
        ]);

        return response()->api($guru, 'Berhasil menonaktifkan data guru', null, Response::HTTP_OK);
    }
}
