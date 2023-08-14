<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Diskon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\Diskon\CreateDiskonRequest;
use App\Http\Requests\API\v1\Diskon\UpdateDiskonRequest;
use App\OpenApi\Parameters\API\v1\Diskon\ListDiskonParameters;
use App\OpenApi\RequestBodies\API\v1\Diskon\CreateDiskonRequestBody;
use App\OpenApi\RequestBodies\API\v1\Diskon\UpdateDiskonRequestBody;

#[OpenApi\PathItem]
class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['diskon'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListDiskonParameters::class)]
    public function index(Request $request)
    {
        $filters =
            [
                'per_page' => $request->query('per_page'),
                'search' => $request->query('search'),
                'status' => $request->query('status'),
            ];

        $perPage = $filters['per_page'] ?? 10;

        $diskonQuery = Diskon::query()
            ->when($filters['search'], fn ($query, $search) => $query->search($search))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status));

        $diskon = $diskonQuery->paginate($perPage);

        if ($diskon->isEmpty()) {
            return response()->api(null, 'Tidak ada data diskon', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($diskon, 'Berhasil mendapatkan data diskon', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['diskon'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateDiskonRequestBody::class)]
    public function store(CreateDiskonRequest $request)
    {
        $validatedData = $request->validated();

        $diskon = Diskon::create($validatedData);

        return response()->api($diskon, 'Diskon berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(id: 'diskon', tags: ['diskon'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(Diskon $diskon)
    {
        return response()->api($diskon, 'Berhasil mendapatkan data diskon', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(id: 'diskon', tags: ['diskon'], method: 'patch', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateDiskonRequestBody::class)]
    public function update(UpdateDiskonRequest $request, Diskon $diskon)
    {
        $validatedData = $request->validated();

        $diskon->update($validatedData);

        return response()->api($diskon, 'Diskon berhasil diupdate', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(id: 'diskon', tags: ['diskon'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(Diskon $diskon)
    {
        $diskon->update(['status' => 'D']);

        return response()->api($diskon, 'Diskon berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
