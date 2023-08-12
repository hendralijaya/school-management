<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\JenisTingkatLomba;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\JenisTingkatLomba\CreateJenisTingkatLombaRequest;
use App\Http\Requests\API\v1\JenisTingkatLomba\UpdateJenisTingkatLombaRequest;
use App\OpenApi\Parameters\API\v1\JenisTingkatLomba\ListJenisTingkatLombaParameters;
use App\OpenApi\RequestBodies\API\v1\JenisTingkatLomba\CreateJenisTingkatLombaRequestBody;
use App\OpenApi\RequestBodies\API\v1\JenisTingkatLomba\UpdateJenisTingkatLombaRequestBody;

#[OpenApi\PathItem]
class JenisTingkatLombaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['jenis-tingkat-lomba'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListJenisTingkatLombaParameters::class)]
    public function index(Request $request)
    {
        $filters =
            [
                'per_page' => $request->input('per_page'),
                'search' => $request->input('search'),
                'status' => $request->input('status'),
            ];

        $perPage = $filters['per_page'] ?? 10;

        $jenisTingkatLombaQuery = JenisTingkatLomba::query()
            ->when($filters['search'], fn ($query, $search) => $query->where('nama', 'like', '%' . $search . '%'))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status));

        $jenisTingkatLomba = $jenisTingkatLombaQuery->paginate($perPage);

        if ($jenisTingkatLomba->isEmpty()) {
            return response()->api(null, 'Tidak ada data jenis tingkat lomba', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($jenisTingkatLomba, 'Berhasil mendapatkan data jenis tingkat lomba', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['jenis-tingkat-lomba'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateJenisTingkatLombaRequestBody::class)]
    public function store(CreateJenisTingkatLombaRequest $request)
    {
        $validatedData = $request->validated();

        $jenisTingkatLomba = JenisTingkatLomba::create($validatedData);

        return response()->api($jenisTingkatLomba, 'Jenis tingkat lomba berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(tags: ['jenis-tingkat-lomba'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(JenisTingkatLomba $jenisTingkatLomba)
    {
        return response()->api($jenisTingkatLomba, 'Berhasil mendapatkan data jenis tingkat lomba', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(tags: ['jenis-tingkat-lomba'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateJenisTingkatLombaRequestBody::class)]
    public function update(UpdateJenisTingkatLombaRequest $request, JenisTingkatLomba $jenisTingkatLomba)
    {
        $validatedData = $request->validated();

        $jenisTingkatLomba->update($validatedData);

        return response()->api($jenisTingkatLomba, 'Jenis tingkat lomba berhasil diperbarui', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(tags: ['jenis-tingkat-lomba'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(JenisTingkatLomba $jenisTingkatLomba)
    {
        $jenisTingkatLomba->update(['status' => 'D']);

        return response()->api($jenisTingkatLomba, 'Jenis tingkat lomba berhasil dihapus', null, Response::HTTP_OK);
    }
}
