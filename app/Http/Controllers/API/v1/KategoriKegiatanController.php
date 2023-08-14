<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\KategoriKegiatan;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\KategoriKegiatan\CreateKategoriKegiatanRequest;
use App\Http\Requests\API\v1\KategoriKegiatan\UpdateKategoriKegiatanRequest;
use App\OpenApi\Parameters\API\v1\KategoriKegiatan\ListKategoriKegiatanParameters;
use App\OpenApi\RequestBodies\API\v1\KategoriKegiatan\CreateKategoriKegiatanRequestBody;
use App\OpenApi\RequestBodies\API\v1\KategoriKegiatan\UpdateKategoriKegiatanRequestBody;

#[OpenApi\PathItem]
class KategoriKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['kategori-kegiatan'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListKategoriKegiatanParameters::class)]
    public function index(Request $request)
    {
        $filters = [
            'per_page' => $request->input('per_page'),
            'search' => $request->input('search'),
            'status' => $request->input('status'),
        ];

        $perPage = $filters['per_page'] ?? 10;

        $kategoriKegiatanQuery = KategoriKegiatan::query()
            ->when($filters['search'], fn ($query, $search) => $query->search($search))
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
    #[OpenApi\Operation(tags: ['kategori-kegiatan'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateKategoriKegiatanRequestBody::class)]
    public function store(CreateKategoriKegiatanRequest $request)
    {
        $validatedData = $request->validated();

        $kategoriKegiatan = KategoriKegiatan::create($validatedData);

        return response()->api($kategoriKegiatan, 'Kategori kegiatan berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(tags: ['kategori-kegiatan'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(KategoriKegiatan $kategoriKegiatan)
    {
        return response()->api($kategoriKegiatan, 'Berhasil mendapatkan data kategori kegiatan', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(tags: ['kategori-kegiatan'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateKategoriKegiatanRequestBody::class)]
    public function update(UpdateKategoriKegiatanRequest $request, KategoriKegiatan $kategoriKegiatan)
    {
        $validatedData = $request->validated();

        $kategoriKegiatan->update($validatedData);

        return response()->api($kategoriKegiatan, 'Kategori kegiatan berhasil diperbarui', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(tags: ['kategori-kegiatan'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(KategoriKegiatan $kategoriKegiatan)
    {
        $kategoriKegiatan->update(['status' => 'D']);

        return response()->api($kategoriKegiatan, 'Kategori kegiatan berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
