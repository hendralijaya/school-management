<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $fillable = [
        'nama',
        'status',
    ];
    public $timestamps = false;
    use HasFactory;

    public function tingkatKelas()
    {
        return $this->hasMany(TingkatKelas::class);
    }
}
