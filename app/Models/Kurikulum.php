<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $table = 'kurikulum';
    protected $fillable = ['nama', 'tahun', 'status'];
    public $timestamps = false;
    use HasFactory;

    public function scopeSearch($query, $search)
    {
        return $query->where('nama', 'like', "%$search%");
    }

    public function scopeFilterByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
