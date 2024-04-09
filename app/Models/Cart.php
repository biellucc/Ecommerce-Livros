<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Customer, Book
};

class Cart extends Model
{
    use HasFactory;

    //Define um relacionamento de n:1 com Cart e Customer
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    //Define um relacionamento de n:n com Cart e Book
    public function books(){
        return $this->belongsToMany(Book::class, 'carts_books','cart_id', 'book_id');
    }

    public function order(){
        return $this->belongsTo(Order::class, 'cart_id', 'id');
    }

}
