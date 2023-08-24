<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\Jurusan\CreateJurusanRequest;
use App\Http\Requests\API\v1\Jurusan\UpdateJurusanRequest;
use App\OpenApi\Parameters\API\v1\Jurusan\ListJurusanParameters;
use App\OpenApi\RequestBodies\API\v1\Jurusan\CreateJurusanRequestBody;
use App\OpenApi\RequestBodies\API\v1\Jurusan\UpdateJurusanRequestBody;

#[OpenApi\PathItem]
class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['jurusan'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListJurusanParameters::class)]
    public function index(Request $request)
    {
        $filters =
            [
                'per_page' => $request->input('per_page', 10),
                'search' => $request->input('search'),
                'status' => $request->input('status'),
            ];

        $jurusanQuery = Jurusan::query()
            ->when($filters['search'], fn ($query, $search) => $query->search($search))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status));

        $jurusan = $jurusanQuery->paginate($filters['per_page']);

        if ($jurusan->isEmpty()) {
            return response()->api(null, 'Tidak ada data jurusan', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($jurusan, 'Berhasil mendapatkan data jurusan', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['jurusan'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateJurusanRequestBody::class)]
    public function store(CreateJurusanRequest $request)
    {
        $validated = $request->validated();

        $jurusan = Jurusan::create($validated);

        return response()->api($jurusan, 'Berhasil menambahkan jurusan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(id: 'jurusan', tags: ['jurusan'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(Jurusan $jurusan)
    {
        return response()->api($jurusan, 'Berhasil mendapatkan data jurusan', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(id: 'jurusan', tags: ['jurusan'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateJurusanRequestBody::class)]
    public function update(UpdateJurusanRequest $request, Jurusan $jurusan)
    {
        $validated = $request->validated();

        $jurusan->update($validated);

        return response()->api($jurusan, 'Berhasil mengubah data jurusan', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(id: 'jurusan', tags: ['jurusan'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(Jurusan $jurusan)
    {
        $jurusan->update(['status' => 'D']);

        return response()->api($jurusan, 'Berhasil menonaktifkan jurusan', null, Response::HTTP_OK);
    }
}
