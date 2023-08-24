<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['nama', 'status', 'tingkat_kelas_id'];
    public $timestamps = false;
    use HasFactory;

    public function tingkatKelas()
    {
        return $this->belongsTo(TingkatKelas::class, 'tingkat_kelas_id', 'id');
    }
}
