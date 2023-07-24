<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
