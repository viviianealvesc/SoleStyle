<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cupom extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'code',
        'discount',
        'expiry_date',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
