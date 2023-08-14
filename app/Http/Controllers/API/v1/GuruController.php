<?php

namespace App\Http\Controllers\API\v1;

use Exception;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\OpenApi\SecuritySchemes\JWTSecurityScheme;
use App\Http\Requests\API\v1\Guru\CreateGuruRequest;
use App\Http\Requests\API\v1\Guru\UpdateGuruRequest;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\OpenApi\Parameters\API\v1\Guru\ListGuruParameters;
use App\OpenApi\RequestBodies\API\v1\Guru\CreateGuruRequestBody;
use App\OpenApi\RequestBodies\API\v1\Guru\UpdateGuruRequestBody;

#[OpenApi\PathItem]
class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    #[OpenApi\Operation(tags: ['guru'], method: 'get', security: JWTSecurityScheme::class)]
    #[OpenApi\Parameters(factory: ListGuruParameters::class)]
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

        $guruQuery = Guru::query()
            ->when($filters['gender'], fn ($query, $gender) => $query->filterByGender($gender))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status))
            ->when(
                $filters['tgl_bergabung_from'] && $filters['tgl_bergabung_to'],
                fn ($query) => $query->filterByTanggalBergabung($filters['tgl_bergabung_from'], $filters['tgl_bergabung_to'])
            )
            ->when($filters['search'], fn ($query, $search) => $query->search($search));

        $guru = $guruQuery->paginate($perPage);

        if ($guru->isEmpty()) {
            return response()->api(null, 'Tidak ada data guru', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($guru, 'Berhasil mendapatkan data guru', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    #[OpenApi\Operation(tags: ['guru'], method: 'post', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: CreateGuruRequestBody::class)]
    public function store(CreateGuruRequest $request)
    {
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();

            $guru = Guru::create([
                'nama' => $validatedData['nama'],
                'no_wa' => $validatedData['no_wa'],
                'gender' => $validatedData['gender'],
                'tgl_bergabung' => $validatedData['tgl_bergabung'],
                'tgl_lahir' => $validatedData['tgl_lahir'],
                'alamat' => $validatedData['alamat'],
            ]);

            $user = new User([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'role_id' => 2,
                'status' => $validatedData['status'],
            ]);

            $guru->user()->save($user);

            DB::commit();
            return response()->api($guru, 'Berhasil menambahkan data guru', null, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->api(null, 'Gagal menambahkan data guru', $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    #[OpenApi\Operation(id: 'guru', tags: ['guru'], method: 'get', security: JWTSecurityScheme::class)]
    public function show(Guru $guru)
    {
        return response()->api($guru, 'Berhasil mendapatkan data guru', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    #[OpenApi\Operation(id: 'guru', tags: ['guru'], method: 'put', security: JWTSecurityScheme::class)]
    #[OpenApi\RequestBody(factory: UpdateGuruRequestBody::class)]
    public function update(UpdateGuruRequest $request, Guru $guru)
    {
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
            $guru->update([
                'nama' => $validatedData['nama'],
                'no_wa' => $validatedData['no_wa'],
                'gender' => $validatedData['gender'],
                'tgl_bergabung' => $validatedData['tgl_bergabung'],
                'tgl_lahir' => $validatedData['tgl_lahir'],
                'alamat' => $validatedData['alamat'],
            ]);
            $guru->user()->update([
                'status' => $validatedData['status'],
            ]);
            DB::commit();
            return response()->api($guru, 'Berhasil mengubah data guru', null, Response::HTTP_OK);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->api(null, 'Gagal mengubah data guru', null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    #[OpenApi\Operation(id: 'guru', tags: ['guru'], method: 'delete', security: JWTSecurityScheme::class)]
    public function deactivate(Guru $guru)
    {
        try {
            $guru->user()->update([
                'status' => 'D',
            ]);
            return response()->api($guru, 'Berhasil menonaktifkan data guru', null, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->api(null, 'Gagal menonaktifkan data guru', null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
