<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrangTua extends Model
{
    protected $table = 'orang_tua';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_wa',
        'gender',
        'tgl_lahir',
        'alamat',
        'status',
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function scopeFilterByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeFilterByGender(Builder $query, string $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeSearch(Builder $query, string $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $searchQuery = '%' . $keyword . '%';
            $query->where('nama', 'LIKE', $searchQuery)
                ->orWhere('no_wa', 'LIKE', $searchQuery)
                ->orWhere('alamat', 'LIKE', $searchQuery);
        });
    }
}
