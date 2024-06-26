<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'cep',
        'city',
        'state',
        'neighborhood',
        'n_house',
        'complement'
    ];

    //De 1:1 com users e address
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
