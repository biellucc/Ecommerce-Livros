<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Address, Customer, Vendor
};

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Define um relacionamento de um para um com o Address
    public function address(){
        return $this->hasOne(Address::class, 'user_id', 'id');
    }

    //Define um relacionamento de um para um com o Customer
    public function customer() {
        return $this->hasOne(Customer::class, 'user_id', 'id');
    }

    //Define um relacionamento de um para um com o Vendor
    public function vendor(){
        return $this->hasOne(Vendor::class, 'user_id', 'id');
    }

}
