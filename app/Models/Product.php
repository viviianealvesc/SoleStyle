<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'numeracao', 'cores', 'quantidade', 'disponivel'];

    public function favoritos()
    {
        return $this->belongsToMany(User::class, 'favoritos');
    }

    public function carrinho()
    {
        return $this->belongsToMany(User::class, 'carrinho');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
