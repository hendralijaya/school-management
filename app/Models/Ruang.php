<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruang extends Model
{
    protected $table = 'ruang';
    protected $fillable = ['nama', 'kapasitas', 'status'];
    public $timestamps = false;
    use HasFactory;

    public function scopeFilterByCapacity(Builder $query, int $from, int $to)
    {
        return $query->whereBetween('kapasitas', [$from, $to]);
    }

    public function scopeFilterByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeSearch(Builder $query, string $search)
    {
        return $query->where('nama', 'like', "%$search%");
    }
}
