<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use App\Http\Requests\API\v1\Role\CreateRoleRequest;
use App\Http\Requests\API\v1\Role\UpdateRoleRequest;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\Parameters\API\v1\Role\ListRoleParameters;
use App\OpenApi\RequestBodies\API\v1\Role\CreateRoleRequestBody;
use App\OpenApi\RequestBodies\API\v1\Role\UpdateRoleRequestBody;

#[OpenApi\PathItem]
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['role'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListRoleParameters::class)]
    public function index(Request $request)
    {
        $filters = [
            'status' => $request->input('status'),
            'search' => $request->input('search'),
        ];

        $perPage = 10; // Set your desired number of results per page.

        $roleQuery = Role::query()
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->when($filters['search'], fn ($query, $search) => $query->search($search));

        $roles = $roleQuery->paginate($perPage);

        if ($roles->isEmpty()) {
            return response()->api(null, 'Tidak ada data role', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($roles, 'Berhasil mendapatkan data role', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['role'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateRoleRequestBody::class)]
    public function store(CreateRoleRequest $request)
    {
        $validatedData = $request->validated();

        $role = Role::create([
            'nama' => $validatedData['nama'],
            'status' => $validatedData['status'],
        ]);

        return response()->api($role, 'Berhasil menambahkan data role', null, 201);
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(tags: ['role'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(Role $role)
    {
        return response()->api($role, 'Berhasil mendapatkan data role', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(tags: ['role'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateRoleRequestBody::class)]
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $validatedData = $request->validated();

        $role->update([
            'nama' => $validatedData['nama'],
            'status' => $validatedData['status'],
        ]);

        return response()->api($role, 'Berhasil mengubah data role', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(tags: ['role'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(Role $role)
    {
        // Check if the role's name is "Admin"
        if ($role->nama === 'Admin') {
            return response()->api(null, 'Cannot deactivate the Admin role', 'Forbidden', Response::HTTP_FORBIDDEN);
        }
        $role->update([
            'status' => 'D',
        ]);

        return response()->api($role, 'Berhasil menonaktifkan data role', null, Response::HTTP_OK);
    }
}
