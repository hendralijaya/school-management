<?php

namespace App\Models;

use App\Models\User;
use App\Models\JabatanGuru;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Guru extends Model
{
    protected $table = 'guru';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'jabatan_guru_id',
        'nama',
        'no_wa',
        'gender',
        'tgl_bergabung',
        'tgl_lahir',
        'alamat',
        'status',
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function jabatanGuru()
    {
        return $this->belongsTo(JabatanGuru::class, 'jabatan_guru_id');
    }

    public function scopeFilterByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeFilterByGender(Builder $query, string $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeFilterByTanggalBergabung(Builder $query, $from, $to)
    {
        return $query->whereBetween('tgl_bergabung', [$from, $to]);
    }

    public function scopeSearch(Builder $query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $searchQuery = '%' . $keyword . '%';
            $query->where('nama', 'LIKE', $searchQuery)
                ->orWhere('no_wa', 'LIKE', $searchQuery)
                ->orWhere('alamat', 'LIKE', $searchQuery);
        });
    }
}
