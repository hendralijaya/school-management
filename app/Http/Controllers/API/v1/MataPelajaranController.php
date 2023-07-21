<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\MataPelajaran\CreateMataPelajaranRequest;
use App\Http\Requests\API\v1\MataPelajaran\UpdateMataPelajaranRequest;

#[OpenApi\PathItem]
class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['mata-pelajaran'], method: 'get', security: JWTSecurityScheme::class)]
    public function index(Request $request)
    {
        $filters =
            [
                'status' => $request->input('status'),
                'search' => $request->input('search'),
                'kategori' => $request->input('kategori'),
            ];

        $perPage = 10; // Set your desired number of results per page.

        $mataPelajaranQuery = MataPelajaran::query()
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->when($filters['search'], fn ($query, $search) => $query->search($search))
            ->when($filters['kategori'], fn ($query, $kategori) => $query->filterByCategory($kategori));

        $mataPelajaran = $mataPelajaranQuery->paginate($perPage);

        if ($mataPelajaran->isEmpty()) {
            return response()->api(null, 'Tidak ada data mata pelajaran', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($mataPelajaran, 'Berhasil mendapatkan data mata pelajaran', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['mata-pelajaran'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateMataPelajaranRequest::class)]
    public function store(CreateMataPelajaranRequest $request)
    {
        $validated = $request->validated();

        $mataPelajaran = MataPelajaran::create($validated);

        return response()->api($mataPelajaran, 'Mata pelajaran berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(tags: ['mata-pelajaran'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(MataPelajaran $mataPelajaran)
    {
        $mapel = MataPelajaran::find($mataPelajaran->id);

        if (!$mapel) {
            return response()->api(null, 'Mata pelajaran tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($mapel, 'Berhasil mendapatkan data mata pelajaran', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(tags: ['mata-pelajaran'], method: 'put', security: JWTSecurityScheme::class)]
    public function update(UpdateMataPelajaranRequest $request, MataPelajaran $mataPelajaran)
    {
        $validated = $request->validated();

        $mapel = MataPelajaran::find($mataPelajaran->id);

        if (!$mapel) {
            return response()->api(null, 'Mata pelajaran tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        $mapel->update($validated);

        return response()->api($mapel, 'Mata pelajaran berhasil diupdate', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(tags: ['mata-pelajaran'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(MataPelajaran $mataPelajaran)
    {
        $mapel = MataPelajaran::find($mataPelajaran->id);

        if (!$mapel) {
            return response()->api(null, 'Mata pelajaran tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        $mapel->update(['status' => 'D']);

        return response()->api($mapel, 'Mata pelajaran berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
