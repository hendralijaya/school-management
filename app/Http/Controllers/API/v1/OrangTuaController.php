<?php

namespace App\Http\Controllers\API\v1;

use Exception;
use App\Models\User;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\OrangTua\CreateOrangTuaRequest;
use App\Http\Requests\API\v1\OrangTua\UpdateOrangTuaRequest;
use App\OpenApi\Parameters\API\v1\OrangTua\ListOrangTuaParameters;
use App\OpenApi\RequestBodies\API\v1\OrangTua\CreateOrangTuaRequestBody;
use App\OpenApi\RequestBodies\API\v1\OrangTua\UpdateOrangTuaRequestBody;

#[OpenApi\PathItem]
class OrangTuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['orang-tua'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListOrangTuaParameters::class)]
    public function index(Request $request)
    {
        $filters = [
            'gender' => $request->input('gender'),
            'status' => $request->input('status'),
            'search' => $request->input('search'),
        ];

        $perPage = 10; // Set your desired number of results per page.

        $orangTuaQuery = OrangTua::with('siswa')
            ->when($filters['gender'], fn ($query, $gender) => $query->filterByGender($gender))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->when($filters['search'], fn ($query, $search) => $query->search($search));

        $orangTua = $orangTuaQuery->paginate($perPage);

        if ($orangTua->isEmpty()) {
            return response()->api(null, 'Tidak ada data orang tua', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($orangTua, 'Berhasil mendapatkan data orang tua', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['orang-tua'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateOrangTuaRequestBody::class)]
    public function store(CreateOrangTuaRequest $request)
    {
        try {
            $validatedData = $request->validated();

            DB::beginTransaction();
            $orangTua = OrangTua::create([
                'nama' => $validatedData['nama'],
                'no_wa' => $validatedData['no_wa'],
                'gender' => $validatedData['gender'],
                'tgl_lahir' => $validatedData['tgl_lahir'],
                'alamat' => $validatedData['alamat'],
                'status' => $validatedData['status'],
            ]);
            $user = new User([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role_id' => 3,
            ]);
            $orangTua->user()->save($user);
            DB::commit();

            return response()->api($orangTua, 'Berhasil menambahkan data orang tua', null, Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->api(null, 'Gagal menyimpan data orang tua', null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(tags: ['orang-tua'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(OrangTua $orangTua)
    {
        return response()->api($orangTua, 'Berhasil mendapatkan data orang tua', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(tags: ['orang-tua'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateOrangTuaRequestBody::class)]
    public function update(UpdateOrangTuaRequest $request, OrangTua $orangTua)
    {
        try {
            $validatedData = $request->validated();

            DB::beginTransaction();
            $orangTua->update([
                'nama' => $validatedData['nama'],
                'no_wa' => $validatedData['no_wa'],
                'gender' => $validatedData['gender'],
                'tgl_lahir' => $validatedData['tgl_lahir'],
                'alamat' => $validatedData['alamat'],
                'status' => $validatedData['status'],
            ]);
            $orangTua->user->update([
                'email' => $validatedData['email'],
            ]);
            DB::commit();

            return response()->api($orangTua, 'Orang tua berhasil diupdate', null, Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->api(null, 'Gagal mengubah data orang tua', null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(tags: ['orang-tua'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(OrangTua $orangTua)
    {
        try {
            DB::beginTransaction();
            $orangTua->user->update([
                'status' => 'D',
            ]);
            $orangTua->update([
                'status' => 'D',
            ]);
            DB::commit();

            return response()->api(null, 'Orang tua berhasil dinonaktifkan', null, Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->api(null, 'Gagal menonaktifkan data orang tua', null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
