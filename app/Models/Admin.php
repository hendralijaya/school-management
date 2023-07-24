<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    protected $table = 'admin';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'no_wa',
        'gender',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterByStatus(Builder $query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeFilterByGender(Builder $query, string $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeSearch(Builder $query, $keyword)
    {
        return $query->where(function ($query) use ($keyword) {
            $searchQuery = '%' . $keyword . '%';
            $query->where('nama', 'LIKE', $searchQuery)
                ->orWhere('no_wa', 'LIKE', $searchQuery);
        });
    }
}
