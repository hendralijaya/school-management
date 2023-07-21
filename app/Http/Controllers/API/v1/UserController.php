<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use App\Http\Requests\API\v1\User\UpdateUserRequest;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\Parameters\API\v1\User\ListUserParameters;
use App\OpenApi\RequestBodies\API\v1\User\UpdateUserRequestBody;

#[OpenApi\PathItem]
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['user'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListUserParameters::class)]
    public function index(Request $request)
    {
        $filters = [
            'role_id' => $request->input('role_id'),
            'status' => $request->input('status'),
            'search' => $request->input('search'),
        ];

        $perPage = 10; // Set your desired number of results per page.

        $userQuery = User::query()
            ->when($filters['role_id'], fn ($query, $roleId) => $query->filterByRoleId($roleId))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->when($filters['search'], fn ($query, $search) => $query->search($search));

        $users = $userQuery->paginate($perPage);

        if ($users->isEmpty()) {
            return response()->api(null, 'Tidak ada data user', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($users, 'Berhasil mendapatkan data user', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(PostUserRequest $request)
    // {
    //     $validatedData = $request->validated();

    //     $user = User::create([
    //         'email' => $validatedData['email'],
    //         'password' => Hash::make($validatedData['password']),
    //         'role_id' => $validatedData['role_id'],
    //     ]);

    //     return response()->api($user, 'User created successfully', null, 201);
    // }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(tags: ['user'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(User $user)
    {
        $user = User::find($user->id);

        if (!$user) {
            return response()->api(null, 'Data user tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($user, 'Berhasil mendapatkan data user', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(tags: ['user'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateUserRequestBody::class)]
    public function update(UpdateUserRequest $request, String $userId)
    {
        $validatedData = $request->validated();

        $user = User::find($userId);

        if (!$user) {
            return response()->api(null, 'Data user tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        $user->update($validatedData);

        return response()->api($user, 'Berhasil mengubah data user', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(null, tags: ['user'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(User $user)
    {
        $user = User::find($user->id);

        if (!$user) {
            return response()->api(null, 'Data user tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        $user->update(['status' => 'D']);

        return response()->api($user, 'Berhasil menonaktifkan data user', null, Response::HTTP_OK);
    }
}
