<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jurusan extends Model
{
    use SoftDeletes;
    protected $table = 'jurusan';
    protected $fillable = [
        'nama',
        'status',
    ];
    public $timestamps = false;
    use HasFactory;

    public function tingkatKelas()
    {
        return $this->hasMany(TingkatKelas::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Handle the deleting event
        static::deleting(function ($jurusan) {
            // Deactivate related TingkatKelas
            $tingkatKelas = $jurusan->tingkatKelas()->update(['status' => 'D']);
        });
    }
}
