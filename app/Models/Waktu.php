<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waktu extends Model
{
    protected $table = 'waktu';
    protected $fillable = [
        'waktu_mulai',
        'waktu_selesai',
        'jenis_waktu',
    ];
    public $timestamps = false;

    use HasFactory;
}
