<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function scopeFilterByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeSearch(Builder $query, string $search)
    {
        return $query->where('nama', 'like', "%$search%");
    }

    public function scopeFilterByCategory(Builder $query, string $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}
