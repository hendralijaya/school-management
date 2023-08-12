<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Kurikulum;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Kurikulum\CreateKurikulumRequest;
use App\Http\Requests\API\v1\Kurikulum\UpdateKurikulumRequest;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = [
            'per_page' => $request->query('per_page'),
            'search' => $request->query('search'),
            'status' => $request->query('status'),
        ];

        $perPage = $filters['per_page'] ?? 10;

        $kurikulumQuery = Kurikulum::query()
            ->when($filters['search'], fn ($query, $search) => $query->search($search))
            ->when($filters['status'], fn ($query, $status) => $query->filterByStatus($status));

        $kurikulum = $kurikulumQuery->paginate($perPage);

        if ($kurikulum->isEmpty()) {
            return response()->api(null, 'Tidak ada data kurikulum', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($kurikulum, 'Berhasil mendapatkan data kurikulum', null, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateKurikulumRequest $request)
    {
        $validatedData = $request->validated();

        $kurikulum = Kurikulum::create($validatedData);

        return response()->api($kurikulum, 'Kurikulum berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kurikulum $kurikulum)
    {
        return response()->api($kurikulum, 'Berhasil mendapatkan detail kurikulum', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKurikulumRequest $request, Kurikulum $kurikulum)
    {
        $validatedData = $request->validated();

        $kurikulum->update($validatedData);

        return response()->api($kurikulum, 'Kurikulum berhasil diperbarui', null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deactivate(Kurikulum $kurikulum)
    {
        $kurikulum->update(['status' => 'D']);

        return response()->api($kurikulum, 'Kurikulum berhasil dinonaktifkan', null, Response::HTTP_OK);
    }
}
