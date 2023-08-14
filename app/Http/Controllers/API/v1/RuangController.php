<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\Ruang\CreateRuangRequest;
use App\Http\Requests\API\v1\Ruang\UpdateRuangRequest;
use App\OpenApi\Parameters\API\v1\Ruang\ListRuangParameters;
use App\OpenApi\RequestBodies\API\v1\Ruang\CreateRuangRequestBody;

#[OpenApi\PathItem]
class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['ruang'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListRuangParameters::class)]
    public function index(Request $request)
    {
        $filters = [
            'capacity_from' => $request->input('capacity_from'),
            'capacity_to' => $request->input('capacity_to'),
            'status' => $request->input('status'),
            'search' => $request->input('search'),
        ];

        $perPage = 10; // Set your desired number of results per page.

        $ruangQuery = Ruang::query()
            ->when($filters['capacity_from'] && $filters['capacity_to'], fn ($query) => $query->filterByCapacity($filters['capacity_from'], $filters['capacity_to']))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->when($filters['search'], fn ($query, $search) => $query->search($search));

        $ruang = $ruangQuery->paginate($perPage);

        if ($ruang->isEmpty()) {
            return response()->api(null, 'Tidak ada data ruang', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($ruang, 'Berhasil mendapatkan data ruang', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['ruang'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateRuangRequestBody::class)]
    public function store(CreateRuangRequest $request)
    {
        $validated = $request->validated();

        $ruang = Ruang::create($validated);

        return response()->api($ruang, 'Ruang berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(id: 'ruang', tags: ['ruang'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(Ruang $ruang)
    {
        return response()->api($ruang, 'Berhasil mendapatkan data ruang', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(id: 'ruang', tags: ['ruang'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateRuangRequestBody::class)]
    public function update(UpdateRuangRequest $request, Ruang $ruang)
    {
        $validated = $request->validated();

        $ruang->update($validated);

        return response()->api($ruang, 'Ruang berhasil diperbarui', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(id: 'ruang', tags: ['ruang'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(Ruang $ruang)
    {
        $ruang->update(['status' => 'D']);

        return response()->api($ruang, 'Ruang berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
