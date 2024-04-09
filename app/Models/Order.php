<?php

namespace App\Models;

use Illuminate\Console\View\Components\Warn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_payment',
        'value'
    ];

    public function transporter(){
        return $this->belongsTo(Transporter::class, 'transporter_id', 'id');
    }

    public function wallet(){
        return $this->belongsTo(Wallet::class, 'wallet_id', 'id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function cart(){
        return $this->hasOne(Cart::class, 'cart_id', 'id');
    }
}
