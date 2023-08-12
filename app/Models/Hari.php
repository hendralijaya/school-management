<?php

namespace App\Models;

use App\Models\KategoriHari;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hari extends Model
{
    protected $table = 'hari';
    protected $fillable = ['kategori_hari_id', 'nama', 'kapasitas', 'status'];
    public $timestamps = false;
    use HasFactory;

    public function kategori_hari()
    {
        return $this->belongsTo(KategoriHari::class);
    }
}
