<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanGuru extends Model
{
    protected $table = 'jabatan_guru';
    protected $fillable = ['nama', 'status'];
    public $timestamps = false;
    use HasFactory;

    public function guru()
    {
        return $this->hasMany(Guru::class, 'jabatan_guru_id', 'id');
    }
}
