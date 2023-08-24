<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\Hari;
use App\Models\Kelas;
use App\Models\Ruang;
use App\Models\Waktu;
use App\Models\MataPelajaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = [
        'mata_pelajaran_id',
        'guru_id',
        'ruang_id',
        'kelas_id',
        'hari_id',
        'waktu_id',
        'status',
    ];
    public $timestamps = false;
    use HasFactory;

    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function hari()
    {
        return $this->belongsTo(Hari::class);
    }

    public function waktu()
    {
        return $this->belongsTo(Waktu::class);
    }

    public function scopeFilterByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }
}
