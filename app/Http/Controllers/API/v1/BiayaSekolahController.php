<?php

namespace App\Http\Controllers\API\v1;

use App\Models\BiayaSekolah;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\BiayaSekolah\CreateBiayaSekolahRequest;
use App\Http\Requests\API\v1\BiayaSekolah\UpdateBiayaSekolahRequest;
use App\OpenApi\Parameters\API\v1\BiayaSekolah\ListBiayaSekolahParameters;
use App\OpenApi\RequestBodies\API\v1\BiayaSekolah\CreateBiayaSekolahRequestBody;
use App\OpenApi\RequestBodies\API\v1\BiayaSekolah\UpdateBiayaSekolahRequestBody;

#[OpenApi\PathItem]
class BiayaSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['biaya-sekolah'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListBiayaSekolahParameters::class)]
    public function index(Request $request)
    {
        $filters =
            [
                'per_page' => $request->input('per_page', 10),
                'search' => $request->input('search'),
                'status' => $request->input('status'),
            ];

        $biayaSekolahQuery = BiayaSekolah::query()
            ->when($filters['search'], fn ($query, $search) => $query->search($search))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status));

        $biayaSekolah = $biayaSekolahQuery->paginate($filters['per_page']);

        if ($biayaSekolah->isEmpty()) {
            return response()->api(null, 'Tidak ada data biaya sekolah', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($biayaSekolah, 'Berhasil mendapatkan data biaya sekolah', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['biaya-sekolah'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateBiayaSekolahRequestBody::class)]
    public function store(CreateBiayaSekolahRequest $request)
    {
        $validatedData = $request->validated();

        $biayaSekolah = BiayaSekolah::create($validatedData);

        return response()->api($biayaSekolah, 'Biaya sekolah berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(id: 'biayaSekolah', tags: ['biaya-sekolah'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(BiayaSekolah $biayaSekolah)
    {
        return response()->api($biayaSekolah, 'Berhasil mendapatkan data biaya sekolah', null, Response::HTTP_OK);
    }
    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(id: 'biayaSekolah', tags: ['biaya-sekolah'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateBiayaSekolahRequestBody::class)]
    public function update(UpdateBiayaSekolahRequest $request, BiayaSekolah $biayaSekolah)
    {
        $validatedData = $request->validated();

        $biayaSekolah->update($validatedData);

        return response()->api($biayaSekolah, 'Biaya sekolah berhasil diupdate', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(id: 'biayaSekolah', tags: ['biaya-sekolah'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(BiayaSekolah $biayaSekolah)
    {
        $biayaSekolah->update(['status' => 'D']);

        return response()->api($biayaSekolah, 'Biaya sekolah berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
