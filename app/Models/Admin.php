<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    protected $table = 'admin';
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_wa',
        'gender',
        'status'
    ];

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
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
