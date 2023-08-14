<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\KategoriWaktu;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\KategoriWaktu\CreateKategoriWaktuRequest;
use App\Http\Requests\API\v1\KategoriWaktu\UpdateKategoriWaktuRequest;
use App\OpenApi\Parameters\API\v1\KategoriWaktu\ListKategoriWaktuParameters;
use App\OpenApi\RequestBodies\API\v1\KategoriWaktu\CreateKategoriWaktuRequestBody;
use App\OpenApi\RequestBodies\API\v1\KategoriWaktu\UpdateKategoriWaktuRequestBody;

#[OpenApi\PathItem]
class KategoriWaktuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['kategori-waktu'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListKategoriWaktuParameters::class)]
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
    #[OpenApi\Operation(tags: ['kategori-waktu'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateKategoriWaktuRequestBody::class)]
    public function store(CreateKategoriWaktuRequest $request)
    {
        $validatedData = $request->validated();

        $kategoriWaktu = KategoriWaktu::create($validatedData);

        return response()->api($kategoriWaktu, 'Kategori waktu berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(id: 'kategoriWaktu', tags: ['kategori-waktu'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(KategoriWaktu $kategoriWaktu)
    {
        return response()->api($kategoriWaktu, 'Berhasil mendapatkan detail kategori waktu', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(id: 'kategoriWaktu', tags: ['kategori-waktu'], method: 'patch', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateKategoriWaktuRequestBody::class)]
    public function update(UpdateKategoriWaktuRequest $request, KategoriWaktu $kategoriWaktu)
    {
        $validatedData = $request->validated();

        $kategoriWaktu->update($validatedData);

        return response()->api($kategoriWaktu, 'Kategori waktu berhasil diperbarui', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(id: 'kategoriWaktu', tags: ['kategori-waktu'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(KategoriWaktu $kategoriWaktu)
    {
        $kategoriWaktu->update(['status' => 'D']);

        return response()->api($kategoriWaktu, 'Kategori waktu berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
