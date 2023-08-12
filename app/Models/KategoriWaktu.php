<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriWaktu extends Model
{
    protected $table = 'kategori_waktu';
    protected $fillable = ['nama', 'status'];
    public $timestamps = false;
    use HasFactory;

    public function waktu()
    {
        return $this->hasMany(Waktu::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('nama', 'like', "%$search%");
    }

    public function scopeFilterByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
