<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_company',
        'phone',
        'email',
        'cnpj'
    ];

    public function orders(){
        return $this->hasMany(Order::class, 'transporter_id', 'id');
    }
}
