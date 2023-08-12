<?php

namespace App\Http\Controllers\API\v1;

use Exception;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\Admin\CreateAdminRequest;
use App\Http\Requests\API\v1\Admin\UpdateAdminRequest;
use App\OpenApi\Parameters\API\v1\Admin\ListAdminParameters;
use App\OpenApi\RequestBodies\API\v1\Admin\CreateAdminRequestBody;
use App\OpenApi\RequestBodies\API\v1\Admin\UpdateAdminRequestBody;

#[OpenApi\PathItem]
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['admin'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListAdminParameters::class)]
    public function index(Request $request)
    {
        $filters = [
            'per_page' => $request->input('per_page'),
            'gender' => $request->input('gender'),
            'status' => $request->input('status'),
            'search' => $request->input('search'),
        ];

        $perPage = $filters['per_page'] ?? 10;

        $adminQuery = Admin::query()
            ->when($filters['gender'], fn ($query, $gender) => $query->filterByGender($gender))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->when($filters['search'], fn ($query, $search) => $query->search($search));

        $admin = $adminQuery->paginate($perPage);

        if ($admin->isEmpty()) {
            return response()->api(null, 'Tidak ada data admin', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($admin, 'Berhasil mendapatkan data admin', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['admin'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateAdminRequestBody::class)]
    public function store(CreateAdminRequest $request)
    {
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
            $user = User::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role_id' => 1,
                'status' => $validatedData['status'],
            ]);

            $admin = $user->userable()->create([
                'nama' => $validatedData['nama'],
                'no_wa' => $validatedData['no_wa'],
                'gender' => $validatedData['gender'],
                'status' => $validatedData['status'],
            ]);
            DB::commit();

            return response()->api($admin, 'Admin berhasil ditambahkan', null, Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->api(null, 'Admin gagal ditambahkan', null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(tags: ['admin'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(Admin $admin)
    {
        return response()->api($admin, 'Berhasil mendapatkan data admin', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(tags: ['admin'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateAdminRequestBody::class)]
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
            $admin->update([
                'nama' => $validatedData['nama'],
                'no_wa' => $validatedData['no_wa'],
                'gender' => $validatedData['gender'],
                'status' => $validatedData['status'],
            ]);

            $admin->user->update([
                'status' => $validatedData['status'],
            ]);
            DB::commit();

            return response()->api($admin, 'Admin berhasil diupdate', null, Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->api(null, 'Admin gagal diupdate', null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(tags: ['admin'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(Admin $admin)
    {
        try {
            DB::beginTransaction();
            $admin->update([
                'status' => 'D',
            ]);

            $admin->user->update([
                'status' => 'D',
            ]);

            DB::commit();

            return response()->api($admin, 'Admin berhasil dinonaktifkan', null, Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->api(null, 'Admin gagal dinonaktifkan', null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
