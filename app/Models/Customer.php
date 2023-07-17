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

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $fillable = [
        'firstName',
        'lastName',
        'birthday',
        'cpf',
        'agender',
    ];

    //De 1:1 com customer e user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //De n:n com customer e book
    public function books()
    {
        return $this->belongsToMany(Book::class, 'customers_books', 'user_id', 'book_id');
    }

    //Define um relacionamento de 1:n com Customer e Cart
    public function carts()
    {
        return $this->hasMany(Cart::class, 'customer_id', 'user_id');
    }

    //Define um relacionamento de n:1 com Comment e Customer
    public function comments(){
        return $this->hasMany(Comment::class, 'customer_id', 'user_id');
    }
}
