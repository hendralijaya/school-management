<?php

namespace App\Http\Controllers\API\v1;

use App\Models\TingkatKelas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\Parameters\API\v1\Jurusan\ListJurusanParameters;
use App\Http\Requests\API\v1\TingkatKelas\CreateTingkatKelasRequest;
use App\Http\Requests\API\v1\TingkatKelas\UpdateTingkatKelasRequest;
use App\OpenApi\RequestBodies\API\v1\TingkatKelas\CreateTingkatKelasRequestBody;
use App\OpenApi\RequestBodies\API\v1\TingkatKelas\UpdateTingkatKelasRequestBody;

#[OpenApi\PathItem]
class TingkatKelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['tingkat-kelas'], method: 'GET', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListJurusanParameters::class)]
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

        $tingkatKelas = $tingkatKelasQuery->with('jurusan')->paginate($perPage);

        if ($tingkatKelas->isEmpty()) {
            return response()->api(null, 'Tidak ada data tingkat kelas', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($tingkatKelas, 'Berhasil mendapatkan data tingkat kelas', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['tingkat-kelas'], method: 'POST', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateTingkatKelasRequestBody::class)]
    public function store(CreateTingkatKelasRequest $request)
    {
        $validated = $request->validated();

        $tingkatKelas = TingkatKelas::create($validated);

        return response()->api($tingkatKelas, 'Tingkat kelas berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(id: 'tingkatKelas', tags: ['tingkat-kelas'], method: 'GET', security: JWTSecurityScheme::class)]
    public function show(TingkatKelas $tingkatKelas)
    {
        return response()->api($tingkatKelas, 'Berhasil mendapatkan data tingkat kelas', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(id: 'tingkatKelas', tags: ['tingkat-kelas'], method: 'PUT', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateTingkatKelasRequestBody::class)]
    public function update(UpdateTingkatKelasRequest $request, TingkatKelas $tingkatKelas)
    {
        $validated = $request->validated();

        $tingkatKelas->update($validated);

        return response()->api($tingkatKelas, 'Tingkat kelas berhasil diperbarui', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(id: 'tingkatKelas', tags: ['tingkat-kelas'], method: 'DELETE', security: JWTSecurityScheme::class)]
    public function deactivate(TingkatKelas $tingkatKelas)
    {
        $tingkatKelas->update(['status' => 'D']);

        return response()->api($tingkatKelas, 'Tingkat kelas berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
