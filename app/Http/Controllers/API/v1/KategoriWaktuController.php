<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\KategoriWaktu;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\KategoriWaktu\CreateKategoriWaktuRequest;
use App\Http\Requests\API\v1\KategoriWaktu\UpdateKategoriWaktuRequest;

class KategoriWaktuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters =
            [
                'per_page' => $request->query('per_page'),
                'search' => $request->query('search'),
                'status' => $request->query('status'),
            ];

        $perPage = $filters['per_page'] ?? 10;

        $kategoriWaktuQuery = KategoriWaktu::query()
            ->when($filters['search'], fn ($query, $search) => $query->search($search))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status));

        $kategoriWaktu = $kategoriWaktuQuery->paginate($perPage);

        if ($kategoriWaktu->isEmpty()) {
            return response()->api(null, 'Tidak ada data kategori waktu', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($kategoriWaktu, 'Berhasil mendapatkan data kategori waktu', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateKategoriWaktuRequest $request)
    {
        $validatedData = $request->validated();

        $kategoriWaktu = KategoriWaktu::create($validatedData);

        return response()->api($kategoriWaktu, 'Kategori waktu berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriWaktu $kategoriWaktu)
    {
        return response()->api($kategoriWaktu, 'Berhasil mendapatkan detail kategori waktu', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriWaktuRequest $request, KategoriWaktu $kategoriWaktu)
    {
        $validatedData = $request->validated();

        $kategoriWaktu->update($validatedData);

        return response()->api($kategoriWaktu, 'Kategori waktu berhasil diperbarui', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deactivate(KategoriWaktu $kategoriWaktu)
    {
        $kategoriWaktu->update(['status' => 'D']);

        return response()->api($kategoriWaktu, 'Kategori waktu berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
