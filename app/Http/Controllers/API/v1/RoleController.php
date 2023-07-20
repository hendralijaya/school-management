<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Role\PostRoleRequest;
use App\Http\Requests\API\v1\Role\UpdateRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();

        if ($roles->isEmpty()) {
            return response()->api(null, 'Tidak ada data role', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($roles, 'Berhasil mendapatkan data role', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRoleRequest $request)
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
    public function show(string $roleId)
    {
        $role = Role::find($roleId);

        if (!$role) {
            return response()->api(null, 'Data role tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($role, 'Berhasil mendapatkan data role', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $roleId)
    {
        $validatedData = $request->validated();

        $role = Role::find($roleId);

        if (!$role) {
            return response()->api(null, 'Data role tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        $role->update([
            'nama' => $validatedData['nama'],
            'status' => $validatedData['status'],
        ]);

        return response()->api($role, 'Berhasil mengubah data role', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deactivate(string $roleId)
    {
        $role = Role::find($roleId);

        if (!$role) {
            return response()->api(null, 'Data role tidak ditemukan', null, Response::HTTP_NOT_FOUND);
        }

        $role->update([
            'status' => 'D',
        ]);

        return response()->api($role, 'Berhasil menonaktifkan data role', null, Response::HTTP_OK);
    }
}
