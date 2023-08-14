<?php

namespace App\Http\Controllers\API\v1;

use App\Models\TingkatKelas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\TingkatKelas\CreateTingkatKelasRequest;
use App\Http\Requests\API\v1\TingkatKelas\UpdateTingkatKelasRequest;

class TingkatKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters =
            [
                'per_page' => $request->input('per_page'),
                'status' => $request->input('status'),
                'search' => $request->input('search'),
            ];
        $perPage = $filters['per_page'] ?? 10;

        $tingkatKelasQuery = TingkatKelas::query()
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->when($filters['search'], fn ($query, $search) => $query->search($search));

        $tingkatKelas = $tingkatKelasQuery->paginate($perPage);

        if ($tingkatKelas->isEmpty()) {
            return response()->api(null, 'Tidak ada data tingkat kelas', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($tingkatKelas, 'Berhasil mendapatkan data tingkat kelas', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTingkatKelasRequest $request)
    {
        $validated = $request->validated();

        $tingkatKelas = TingkatKelas::create($validated);

        return response()->api($tingkatKelas, 'Tingkat kelas berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(TingkatKelas $tingkatKelas)
    {
        return response()->api($tingkatKelas, 'Berhasil mendapatkan data tingkat kelas', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTingkatKelasRequest $request, TingkatKelas $tingkatKelas)
    {
        $validated = $request->validated();

        $tingkatKelas->update($validated);

        return response()->api($tingkatKelas, 'Tingkat kelas berhasil diperbarui', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deactivate(TingkatKelas $tingkatKelas)
    {
        $tingkatKelas->update(['status' => 'D']);

        return response()->api($tingkatKelas, 'Tingkat kelas berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
