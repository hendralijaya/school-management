<?php

namespace Database\Seeders;

use App\Models\Kurikulum;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KurikulumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [["nama" => "Kurikulum K-13", "tahun" => "2013", "status" => "A"], ["nama" => "Kurikulum KTSP", "tahun" => "2006", "status" => "A"]];
        // insert data to database using model
        Kurikulum::insert($data);
    }
}
