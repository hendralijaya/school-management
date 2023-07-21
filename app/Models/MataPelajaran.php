<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';
    protected $fillable = [
        'nama',
        'kategori',
        'status',
    ];
    public $timestamps = false;
    use HasFactory;
}
