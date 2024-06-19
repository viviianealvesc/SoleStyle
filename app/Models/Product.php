<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 
        'descricao', 
        'numeracao', 
        'cores', 
        'quantidade', 
        'disponivel',
        'avatar',
        'imagem',
        'discount',
        'estoque',
        'marca',
        'preco',
    ];

    protected $casts = [
        'numeracao' => 'array',
        'cores' => 'array', 
        'avatar' => 'array',
    ];
    

    public function favoritos()
    {
        return $this->belongsToMany(User::class, 'favoritos');
    }

    public function carrinho()
    {
        return $this->belongsToMany(User::class, 'carrinhos');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
