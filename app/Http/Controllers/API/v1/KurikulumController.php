<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\Kurikulum\CreateKurikulumRequest;
use App\Http\Requests\API\v1\Kurikulum\UpdateKurikulumRequest;
use App\OpenApi\Parameters\API\v1\Kurikulum\ListKurikulumParameters;
use App\OpenApi\RequestBodies\API\v1\Kurikulum\CreateKurikulumRequestBody;
use App\OpenApi\RequestBodies\API\v1\Kurikulum\UpdateKurikulumRequestBody;

#[OpenApi\PathItem]
class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['kurikulum'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListKurikulumParameters::class)]
    public function index(Request $request)
    {
        $filters = [
            'per_page' => $request->query('per_page'),
            'search' => $request->query('search'),
            'status' => $request->query('status'),
        ];

        $perPage = $filters['per_page'] ?? 10;

        $kurikulumQuery = Kurikulum::query()
            ->when($filters['search'], fn ($query, $search) => $query->search($search))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status));

        $kurikulum = $kurikulumQuery->paginate($perPage);

        if ($kurikulum->isEmpty()) {
            return response()->api(null, 'Tidak ada data kurikulum', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($kurikulum, 'Berhasil mendapatkan data kurikulum', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['kurikulum'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateKurikulumRequestBody::class)]
    public function store(CreateKurikulumRequest $request)
    {
        $validatedData = $request->validated();

        $kurikulum = Kurikulum::create($validatedData);

        return response()->api($kurikulum, 'Kurikulum berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(id: 'kurikulum', tags: ['kurikulum'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(Kurikulum $kurikulum)
    {
        return response()->api($kurikulum, 'Berhasil mendapatkan detail kurikulum', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(id: 'kurikulum', tags: ['kurikulum'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateKurikulumRequestBody::class)]
    public function update(UpdateKurikulumRequest $request, Kurikulum $kurikulum)
    {
        $validatedData = $request->validated();

        $kurikulum->update($validatedData);

        return response()->api($kurikulum, 'Kurikulum berhasil diperbarui', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(id: 'kurikulum', tags: ['kurikulum'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(Kurikulum $kurikulum)
    {
        $kurikulum->update(['status' => 'D']);

        return response()->api($kurikulum, 'Kurikulum berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
