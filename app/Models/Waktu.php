<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waktu extends Model
{
    protected $table = 'waktu';
    protected $fillable = [
        'kategori_waktu_id',
        'waktu_mulai',
        'waktu_selesai',
    ];
    public $timestamps = false;

    use HasFactory;
}
