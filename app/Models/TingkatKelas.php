<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TingkatKelas extends Model
{
    use SoftDeletes;
    protected $table = 'tingkat_kelas';
    protected $fillable = ['nama', 'status', 'jurusan_id'];
    protected $hidden = ['jurusan_id']; // Hide these attributes by default
    public $timestamps = false;
    use HasFactory;

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function scopeFilterByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeSearch(Builder $query, string $search)
    {
        return $query->where('nama', 'like', '%' . $search . '%');
    }

    protected static function boot()
    {
        parent::boot();

        // Handle the deleting event
        static::deleting(function ($tingkatKelas) {
            // Deactivate related TingkatKelas
            $tingkatKelas->kelas()->update(['status' => 'D']);
        });
    }
}
