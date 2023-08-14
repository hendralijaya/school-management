<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\KategoriKegiatan;
use App\Http\Controllers\Controller;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\KategoriKegiatan\CreateKategoriKegiatanRequest;
use App\Http\Requests\API\v1\KategoriKegiatan\UpdateKategoriKegiatanRequest;

#[OpenApi\PathItem]
class KategoriKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = [
            'per_page' => $request->input('per_page'),
            'nama_kategori' => $request->input('nama_kategori'),
            'status' => $request->input('status'),
        ];

        $perPage = $filters['per_page'] ?? 10;

        $kategoriKegiatanQuery = KategoriKegiatan::query()
            ->when($filters['nama_kategori'], fn ($query, $nama_kategori) => $query->filterByNamaKategori($nama_kategori))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status));

        $kategoriKegiatan = $kategoriKegiatanQuery->paginate($perPage);

        if ($kategoriKegiatan->isEmpty()) {
            return response()->api(null, 'Tidak ada data kategori kegiatan', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($kategoriKegiatan, 'Berhasil mendapatkan data kategori kegiatan', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateKategoriKegiatanRequest $request)
    {
        $validatedData = $request->validated();

        $kategoriKegiatan = KategoriKegiatan::create($validatedData);

        return response()->api($kategoriKegiatan, 'Kategori kegiatan berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriKegiatan $kategoriKegiatan)
    {
        return response()->api($kategoriKegiatan, 'Berhasil mendapatkan data kategori kegiatan', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriKegiatanRequest $request, KategoriKegiatan $kategoriKegiatan)
    {
        $validatedData = $request->validated();

        $kategoriKegiatan->update($validatedData);

        return response()->api($kategoriKegiatan, 'Kategori kegiatan berhasil diperbarui', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deactivate(KategoriKegiatan $kategoriKegiatan)
    {
        $kategoriKegiatan->update(['status' => 'D']);

        return response()->api($kategoriKegiatan, 'Kategori kegiatan berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
