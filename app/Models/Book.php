<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Vendor,Customer, Comment
};

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'pages',
        'author',
        'amount',
        'value',
        'image',
    ];

    //De n:1 com book e vendor
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'user_id');
    }

    //De n:n com book e customer
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customers_books', 'book_id','user_id');
    }

    //Define um relacionamento de n:n com Cart e Book
    public function carts(){
        return $this->belongsToMany(Cart::class, 'carts_books', 'book_id', 'cart_id');
    }

    //Define um relacionamento de n:1 com Comment e Book
    public function comments(){
        return $this->hasMany(Comment::class, 'book_id', 'id');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('imagem/' . $this->image);
        }
        return null;
    }
}
