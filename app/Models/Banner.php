<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'banner'];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
