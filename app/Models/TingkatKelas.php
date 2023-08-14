<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatKelas extends Model
{
    protected $table = 'tingkat_kelas';
    protected $fillable = ['nama', 'status', 'jurusan_id'];
    public $timestamps = false;
    use HasFactory;

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
