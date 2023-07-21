<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hari extends Model
{
    protected $table = 'hari';
    protected $fillable = ['nama', 'kapasitas', 'status'];
    public $timestamps = false;
    use HasFactory;
}
