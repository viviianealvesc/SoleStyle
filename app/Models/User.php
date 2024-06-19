<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Product;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cupons()
    {
        return $this->belongsToMany(Cupom::class, 'cupom_usados');
    }

    public function favoritos()
    {
        return $this->belongsToMany(Product::class, 'favoritos');
    }

    public function carrinho()
    {
        return $this->belongsToMany(Product::class, 'carrinhos');
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

}
