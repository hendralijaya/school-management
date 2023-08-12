<?php

namespace App\Models;

use App\Models\Hari;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriHari extends Model
{
    protected $table = 'kategori_hari';
    protected $fillable = ['nama', 'status'];
    public $timestamps = false;
    use HasFactory;

    public function hari()
    {
        return $this->hasMany(Hari::class);
    }

    public function scopeSearch(Builder $query, string $search)
    {
        return $query->where('nama', 'like', "%$search%");
    }

    public function scopeFilterByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }
}
