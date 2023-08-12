<?php

namespace App\Http\Controllers\API\v1;

use Exception;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\Siswa\CreateSiswaRequest;
use App\Http\Requests\API\v1\Siswa\UpdateSiswaRequest;
use App\OpenApi\Parameters\API\v1\Siswa\ListSiswaParameters;
use App\OpenApi\RequestBodies\API\v1\Siswa\CreateSiswaRequestBody;

#[OpenApi\PathItem]
class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    #[OpenApi\Operation(tags: ['siswa'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListSiswaParameters::class)]
    public function index(Request $request)
    {
        $filters = [
            'gender' => $request->input('gender'),
            'status' => $request->input('status'),
            'tgl_bergabung_from' => $request->input('tgl_bergabung_from'),
            'tgl_bergabung_to' => $request->input('tgl_bergabung_to'),
            'search' => $request->input('search'),
        ];

        $perPage = 10; // Set your desired number of results per page.

        $siswaQuery = Siswa::query()
            ->when($filters['gender'], fn ($query, $gender) => $query->filterByGender($gender))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->when(
                $filters['tgl_bergabung_from'] && $filters['tgl_bergabung_to'],
                fn ($query) => $query->filterByTanggalBergabung($filters['tgl_bergabung_from'], $filters['tgl_bergabung_to'])
            )
            ->when($filters['search'], fn ($query, $search) => $query->search($search));

        $siswa = $siswaQuery->paginate($perPage);

        if ($siswa->isEmpty()) {
            return response()->api(null, 'Tidak ada data siswa', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($siswa, 'Berhasil mendapatkan data siswa', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['siswa'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateSiswaRequestBody::class)]
    public function store(CreateSiswaRequest $request)
    {
        try {
            $validatedData = $request->validated();
            // seperate data siswa and data user
            DB::beginTransaction();

            $siswa = Siswa::create([
                'nama' => $validatedData['nama'],
                'no_wa' => $validatedData['no_wa'],
                'gender' => $validatedData['gender'],
                'tgl_bergabung' => $validatedData['tgl_bergabung'],
                'tgl_lahir' => $validatedData['tgl_lahir'],
                'alamat' => $validatedData['alamat'],
                'status' => $validatedData['status'],
                'orang_tua_id' => $validatedData['orang_tua_id'],
            ]);

            $user = new User([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role_id' => 2,
                'status' => $validatedData['status'],
            ]);

            $siswa->user()->save($user);

            DB::commit();

            return response()->api($siswa, 'Berhasil menambahkan data siswa', null, Response::HTTP_CREATED);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->api(null, 'Gagal menambahkan data siswa', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(tags: ['siswa'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(Siswa $siswa)
    {
        return response()->api($siswa, 'Berhasil mendapatkan data siswa', null, Response::HTTP_OK);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $siswaId)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(tags: ['siswa'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateSiswaRequestBody::class)]
    public function update(UpdateSiswaRequest $request, Siswa $siswa)
    {
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
            $siswa->update([
                'nama' => $validatedData['nama'],
                'no_wa' => $validatedData['no_wa'],
                'gender' => $validatedData['gender'],
                'tgl_bergabung' => $validatedData['tgl_bergabung'],
                'tgl_lahir' => $validatedData['tgl_lahir'],
                'alamat' => $validatedData['alamat'],
                'status' => $validatedData['status'],
            ]);

            $siswa->user()->update([
                'status' => $validatedData['status'],
            ]);
            DB::commit();
            return response()->api($siswa, 'Berhasil mengubah data siswa', null, Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->api(null, 'Gagal mengubah data siswa', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(tags: ['siswa'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(Siswa $siswa)
    {
        try {
            DB::beginTransaction();
            $siswa->update([
                'status' => 'D',
            ]);
            $siswa->user()->update([
                'status' => 'D',
            ]);
            DB::commit();
            return response()->api($siswa, 'Berhasil menonaktifkan data siswa', null, Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->api(null, 'Gagal menonaktifkan data siswa', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
