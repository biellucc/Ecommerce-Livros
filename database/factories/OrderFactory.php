<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Transporter;
use App\Models\Customer;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type_payment' => Wallet::pluck('type_wallet')->random(),
            'value' => $this->faker->randomFloat(2,10, 1000),
            'customer_id'=> Customer::pluck('id')->random(),
            'wallet_id' => Wallet::pluck('id')->random(),
            'transporter_id' => Transporter::pluck('id')->random(),
            'cart_id' => Cart::pluck('id')->random()
        ];
    }
}
