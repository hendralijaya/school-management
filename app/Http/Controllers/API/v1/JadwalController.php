<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Jadwal\CreateJadwalRequest;
use App\Http\Requests\API\v1\Jadwal\UpdateJadwalRequest;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters =
            [
                'per_page' => $request->input('per_page', 10),
                'status' => $request->input('status'),
            ];

        $jadwal = Jadwal::query()
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->paginate($filters['per_page']);

        if ($jadwal->isEmpty()) {
            return response()->api(null, 'Tidak ada data jadwal', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($jadwal, 'Berhasil mendapatkan data jadwal', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateJadwalRequest $request)
    {
        $validated = $request->validated();

        $jadwal = Jadwal::create($validated);

        return response()->api($jadwal, 'Berhasil menambahkan jadwal', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        return response()->api($jadwal, 'Berhasil mendapatkan jadwal', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJadwalRequest $request, Jadwal $jadwal)
    {
        $validated = $request->validated();

        $jadwal->update($validated);

        return response()->api($jadwal, 'Berhasil memperbarui jadwal', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deactivate(Jadwal $jadwal)
    {
        $jadwal->update(['status' => 'D']);

        return response()->api($jadwal, 'Berhasil menonaktifkan jadwal', null, Response::HTTP_OK);
    }
}
