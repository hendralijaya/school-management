<?php

namespace App\Http\Controllers\API\v1;

use App\Models\JabatanGuru;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\JabatanGuru\CreateJabatanGuruRequest;
use App\Http\Requests\API\v1\JabatanGuru\UpdateJabatanGuruRequest;
use App\OpenApi\Parameters\API\v1\JabatanGuru\ListJabatanGuruParameters;
use App\OpenApi\RequestBodies\API\v1\JabatanGuru\CreateJabatanGuruRequestBody;

#[OpenApi\PathItem]
class JabatanGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['jabatan-guru'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListJabatanGuruParameters::class)]
    public function index(Request $request)
    {
        $filters =
            [
                'per_page' => $request->query('per_page', 10),
                'search' => $request->query('search'),
                'status' => $request->query('status'),
            ];

        $jabatanGuruQuery = JabatanGuru::query()
            ->when($filters['search'], fn ($query, $search) => $query->search($search))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status));

        $jabatanGuru = $jabatanGuruQuery->paginate($filters['per_page']);

        if ($jabatanGuru->isEmpty()) {
            return response()->api(null, 'Tidak ada data jabatan guru', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($jabatanGuru, 'Berhasil mendapatkan data jabatan guru', null, Response::HTTP_OK);
    }
    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['jabatan-guru'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateJabatanGuruRequestBody::class)]
    public function store(CreateJabatanGuruRequest $request)
    {
        $validatedData = $request->validated();

        $jabatanGuru = JabatanGuru::create($validatedData);

        return response()->api($jabatanGuru, 'Jabatan Guru berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(id: 'jabatanGuru', tags: ['jabatan-guru'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(JabatanGuru $jabatanGuru)
    {
        return response()->api($jabatanGuru, 'Berhasil mendapatkan data Jabatan Guru', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(id: 'jabatanGuru', tags: ['jabatan-guru'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateJabatanGuruRequestBody::class)]
    public function update(UpdateJabatanGuruRequest $request, JabatanGuru $jabatanGuru)
    {
        $validatedData = $request->validated();

        $jabatanGuru->update($validatedData);

        return response()->api($jabatanGuru, 'Jabatan Guru berhasil diupdate', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(id: 'jabatanGuru', tags: ['jabatan-guru'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(JabatanGuru $jabatanGuru)
    {
        $jabatanGuru->update(['status' => 'D']);

        return response()->api($jabatanGuru, 'Jabatan Guru berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
