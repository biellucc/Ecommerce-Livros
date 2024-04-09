<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'cvc',
        'number_wallet',
        'type_wallet',
        'validate'
    ];

    //Define um relacionamento de 1:n com Customers e Wallets
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    //Define um relacionamento de 1:n com Wallets e Payments
    public function order(){
        return $this->hasMany(Order::class, 'wallet_id', 'id');
    }
}
