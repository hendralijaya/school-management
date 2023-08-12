<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKegiatan extends Model
{
    protected $table = 'kategori_kegiatan';
    protected $fillable = ['nama', 'status'];
    public $timestamps = false;
    use HasFactory;

    public function scopeSearch(Builder $query, string $search)
    {
        return $query->where('nama', 'like', "%$search%");
    }

    public function scopeFilterByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }
}
