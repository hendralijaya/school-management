<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Libur;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\Libur\CreateLiburRequest;
use App\Http\Requests\API\v1\Libur\GenerateLiburRequest;
use App\Http\Requests\API\v1\Libur\UpdateLiburRequest;

class LiburController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters =
            [
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'per_page' => $request->input('per_page'),
            ];

        // make filterByDate 
        $liburQuery = Libur::query()
            ->when($filters['start_date'] && $filters['end_date'], fn ($query) => $query->filterByDate($filters['start_date'], $filters['end_date']));

        $libur = $liburQuery->paginate($filters['per_page']);

        if ($libur->isEmpty()) {
            return response()->api(null, 'Tidak ada data libur', null, Response::HTTP_NOT_FOUND);
        }

        return response()->api($libur, 'Berhasil mendapatkan data libur', null, Response::HTTP_OK);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateLiburRequest $request)
    {
        $validated = $request->validated();

        $libur = Libur::create($validated);

        return response()->api($libur, 'Libur berhasil ditambahkan', null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Libur $libur)
    {
        return response()->api($libur, 'Berhasil mendapatkan data libur', null, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLiburRequest $request, Libur $libur)
    {
        $validated = $request->validated();

        $libur->update($validated);

        return response()->api($libur, 'Libur berhasil diupdate', null, Response::HTTP_OK);
    }

    public function generateLibur(GenerateLiburRequest $request)
    {
        $validated = $request->validated();

        $startDate = $validated['start_date'];
        $endDate = $validated['end_date'];

        $liburData = [];

        if (isset($validated['nama_hari_raya'])) {
            foreach ($validated['nama_hari_raya'] as $key => $value) {
                $liburData[] = [
                    'nama_hari_raya' => $value,
                    'tanggal_mulai' => $validated['tanggal_mulai'][$key],
                    'tanggal_selesai' => $validated['tanggal_selesai'][$key],
                    'kategori_hari_id' => $validated['kategori_hari_id'][$key]
                ];
            }
        }

        $holidays = Libur::getHolidaysFromGoogleCalendarApi($startDate, $endDate, ['Idul Fitri', 'Natal', 'Tahun Baru', 'Cuti Bersama']);
        foreach ($holidays as $holiday) {
            $kategori_hari_id = $this->determineKategoriHariId($holiday['nama_hari_raya']);
            $liburData[] = [
                'nama_hari_raya' => $holiday['nama_hari_raya'],
                'tanggal_mulai' => $holiday['tanggal_mulai'],
                'tanggal_selesai' => $holiday['tanggal_selesai'],
                'kategori_hari_id' => $kategori_hari_id,
            ];
        }

        Libur::insert($liburData);

        return response()->api(null, 'Hari Libur berhasil di generate', null, Response::HTTP_CREATED);
    }

    private function determineKategoriHariId($nama_hari_raya)
    {
        $hariNonLibur = ['Hari Batik', 'Hari Ayah', 'Hari Guru', 'Hari Ibu', 'Hari Paskah (Minggu)', 'Hari Kartini', 'Ramadan Start'];

        if (in_array($nama_hari_raya, $hariNonLibur)) {
            return 1; // Kategori Hari ID for non-libur days
        } else {
            return 3; // Kategori Hari ID for libur days
        }
    }
}
