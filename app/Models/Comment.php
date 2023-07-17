<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Customer, Book
};

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'book_id',
    ];

    //Define um relacionamento de n:1 com Comment e Customer
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'user_id');
    }

    //Define um relacionamento de n:1 com Comment e Book
    public function book(){
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }
}
