<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    protected $table = 'role';
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'status'
    ];

    public function scopeFilterByStatus(Builder $query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeSearch(Builder $query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $searchQuery = '%' . $keyword . '%';
            $query->where('nama', 'LIKE', $searchQuery);
        });
    }
}
