<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    User, Book
    };

class Vendor extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_id';

    public $incrementing = false;

    protected $fillable = [
        'cnpj',
        'nameBussines',
    ];

    //De 1:1 com user e vendor
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    //De 1:n com vendor e book
    public function books()
    {
        return $this->hasMany(Book::class, 'vendor_id', 'user_id');
    }
}
