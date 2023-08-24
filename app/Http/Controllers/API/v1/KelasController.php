<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\Kelas\CreateKelasRequest;
use App\Http\Requests\API\v1\Kelas\UpdateKelasRequest;
use App\OpenApi\RequestBodies\API\v1\Kelas\CreateKelasRequestBody;
use App\OpenApi\RequestBodies\API\v1\Kelas\UpdateKelasRequestBody;

#[OpenApi\PathItem]
class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // #[OpenApi\Operation(tags: ['kelas'], method: 'GET', security: JWTSecurityScheme::class)]
    public function index(Request $request)
    {
        $filters =
            [
                'per_page' => $request->input('per_page', 10),
                'search' => $request->input('search'),
                'status' => $request->input('status'),
            ];

        $kelasQuery = Kelas::query()
            ->when($filters['search'], fn ($query, $search) => $query->search($search))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status));

        $kelas = $kelasQuery->paginate($filters['per_page']);

        if ($kelas->isEmpty()) {
            return response()->api(null, 'Tidak ada data kelas', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($kelas, 'Berhasil mendapatkan data kelas', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    // #[OpenApi\Operation(tags: ['kelas'], method: 'POST', security: JWTSecurityScheme::class)]
    // #[OpenApi\RequestBody(factory: CreateKelasRequestBody::class)]
    public function store(CreateKelasRequest $request)
    {
        $validated = $request->validated();

        $kelas = Kelas::create($validated);

        return response()->api($kelas, 'Berhasil menambahkan data kelas', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    // #[OpenApi\Operation(id: 'kelas', tags: ['kelas'], method: 'GET', security: JWTSecurityScheme::class)]
    public function show(Kelas $kelas)
    {
        return response()->api($kelas, 'Berhasil mendapatkan data kelas', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    // #[OpenApi\Operation(id: 'kelas', tags: ['kelas'], method: 'PUT', security: JWTSecurityScheme::class)]
    // #[OpenApi\RequestBody(factory: UpdateKelasRequestBody::class)]
    public function update(UpdateKelasRequest $request, Kelas $kelas)
    {
        $validated = $request->validated();

        $kelas->update($validated);

        return response()->api($kelas, 'Berhasil memperbarui data kelas', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    // #[OpenApi\Operation(id: 'kelas', tags: ['kelas'], method: 'DELETE', security: JWTSecurityScheme::class)]
    public function deactivate(Kelas $kelas)
    {
        $kelas->update(['status' => 'D']);

        return response()->api($kelas, 'Berhasil menonaktifkan data kelas', null, Response::HTTP_OK);
    }
}
