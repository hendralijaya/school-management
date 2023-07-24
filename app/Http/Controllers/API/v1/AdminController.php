<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;
use App\Http\Requests\API\v1\Admin\CreateAdminRequest;
use App\Http\Requests\API\v1\Admin\UpdateAdminRequest;

#[OpenApi\PathItem]
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = [
            'gender' => $request->input('gender'),
            'status' => $request->input('status'),
            'search' => $request->input('search'),
        ];

        $perPage = 10;

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
    public function store(CreateAdminRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => 1,
        ]);

        $admin = Admin::create([
            'user_id' => $user->id,
            'nama' => $validatedData['nama'],
            'no_wa' => $validatedData['no_wa'],
            'gender' => $validatedData['gender'],
            'status' => $validatedData['status'],
        ]);

        return response()->api($admin, 'Admin berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        $admin = Admin::find($admin->id);

        if (!$admin) {
            return response()->api(null, 'Admin tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($admin, 'Berhasil mendapatkan data admin', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $validatedData = $request->validated();

        $admin = Admin::find($admin->id);

        if (!$admin) {
            return response()->api(null, 'Admin tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        $admin->update([
            'nama' => $validatedData['nama'],
            'no_wa' => $validatedData['no_wa'],
            'gender' => $validatedData['gender'],
            'status' => $validatedData['status'],
        ]);

        return response()->api($admin, 'Admin berhasil diupdate', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deactivate(Admin $admin)
    {
        $admin = Admin::find($admin->id);

        if (!$admin) {
            return response()->api(null, 'Admin tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        $admin->update([
            'status' => 'D',
        ]);

        return response()->api($admin, 'Admin berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
