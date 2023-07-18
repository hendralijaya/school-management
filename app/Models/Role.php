<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    private $table = 'role';
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'name',
    ];
}
