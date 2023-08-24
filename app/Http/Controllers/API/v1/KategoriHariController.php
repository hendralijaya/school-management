<?php

namespace App\Http\Controllers\API\v1;

use App\Models\KategoriHari;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\KategoriHari\CreateKategoriHariRequest;
use App\Http\Requests\API\v1\KategoriHari\UpdateKategoriHariRequest;
use App\OpenApi\Parameters\API\v1\KategoriHari\ListKategoriHariParameters;
use App\Http\Requests\API\v1\KategoriKegiatan\UpdateKategoriKegiatanRequest;
use App\OpenApi\RequestBodies\API\v1\KategoriHari\CreateKategoriHariRequestBody;
use App\OpenApi\RequestBodies\API\v1\KategoriHari\UpdateKategoriHariRequestBody;

#[OpenApi\PathItem]
class KategoriHariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['kategori-hari'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListKategoriHariParameters::class)]
    public function index(Request $request)
    {
        $filters =
            [
                'per_page' => $request->input('per_page', 10),
                'search' => $request->input('search'),
                'status' => $request->input('status'),
            ];

        $kategoriHariQuery = KategoriHari::query()
            ->when($filters['search'], fn ($query, $search) => $query->search($search))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status));

        $kategoriHari = $kategoriHariQuery->paginate($filters['per_page']);

        if ($kategoriHari->isEmpty()) {
            return response()->api(null, 'Tidak ada data kategori hari', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($kategoriHari, 'Berhasil mendapatkan data kategori hari', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['kategori-hari'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateKategoriHariRequestBody::class)]
    public function store(CreateKategoriHariRequest $request)
    {
        $validatedData = $request->validated();

        $kategoriHari = KategoriHari::create($validatedData);

        return response()->api($kategoriHari, 'Kategori hari berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(id: 'kategoriHari', tags: ['kategori-hari'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(KategoriHari $kategoriHari)
    {
        return response()->api($kategoriHari, 'Berhasil mendapatkan data kategori hari', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(id: 'kategoriHari', tags: ['kategori-hari'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateKategoriHariRequestBody::class)]
    public function update(UpdateKategoriHariRequest $request, KategoriHari $kategoriHari)
    {
        $validatedData = $request->validated();

        $kategoriHari->update($validatedData);

        return response()->api($kategoriHari, 'Kategori hari berhasil diperbarui', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(id: 'kategoriHari', tags: ['kategori-hari'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(KategoriHari $kategoriHari)
    {
        $kategoriHari->update(['status' => 'D']);

        return response()->api($kategoriHari, 'Kategori hari berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
