<?php

namespace App\Models;

use App\Models\User;
use App\Models\OrangTua;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    protected $table = 'siswa';
    public $timestamps = false;
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'no_wa',
        'gender',
        'tgl_bergabung',
        'tgl_lahir',
        'alamat',
        'status',
        'orang_tua_id'
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class);
    }

    public function scopeFilterByStatus(Builder $query, string $status)
    {
        return $query->whereHas('user', function ($query) use ($status) {
            $query->where('status', $status);
        });
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
