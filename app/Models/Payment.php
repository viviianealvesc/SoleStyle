<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'stripe_session_id',
        'currency',
        'user_id',
        'product_id',
        'endereco_id', 
        'cor', 
        'numeracao', 
        'total', 
        'status', 
        'quantity',
        'tracking_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }
}
