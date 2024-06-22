<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estrela extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ponto',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
