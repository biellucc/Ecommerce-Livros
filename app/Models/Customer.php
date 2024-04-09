<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    User, Book, Cart,Comment
};

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstName',
        'lastName',
        'birthday',
        'cpf',
        'gender',
    ];

    //De 1:1 com customer e user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //Define um relacionamento de 1:n com Customer e Cart
    public function carts()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }

    //Define um relacionamento de n:1 com Comment e Customer
    public function comments(){
        return $this->hasMany(Comment::class, 'customer_id', 'id');
    }

    public function wallets()
    {
        return $this->hasMany(Wallet::class, 'customer_id', 'id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

}
