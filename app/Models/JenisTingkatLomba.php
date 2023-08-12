<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisTingkatLomba extends Model
{
    protected $table = 'jenis_tingkat_lomba';
    protected $fillable = ['nama', 'status'];
    public $timestamps = false;
    use HasFactory;

    public function scopeFilterByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeSearch(Builder $query, string $search)
    {
        return $query->where('nama_jenis_lomba', 'like', "%$search%");
    }
}
