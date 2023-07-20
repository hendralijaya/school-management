<?php

namespace App\Http\Controllers\API;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Siswa\PostSiswaRequest;
use App\Http\Requests\Siswa\UpdateSiswaRequest;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all();
        return response()->api($siswa, 'Berhasil mendapatkan data siswa', null, 200);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {

    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostSiswaRequest $request)
    {
        $validatedData = $request->validated();

        $siswa = Siswa::create($validatedData);

        return response()->api($siswa, 'Berhasil menambahkan data siswa', null, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::find($id);
        return response()->api($siswa, 'Berhasil mendapatkan data siswa', null, 200);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSiswaRequest $request, string $id)
    {
        $request->validated();

        $siswa = Siswa::find($id);
        $siswa->update($request->all());

        return response()->api($siswa, 'Berhasil mengubah data siswa', null, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();

        return response()->api($siswa, 'Berhasil menghapus data siswa', null, 200);
    }
}
