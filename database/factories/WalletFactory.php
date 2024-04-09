<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\wallets>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::pluck('id')->random(),
            'cvc' => $this->faker->unique()->randomNumber(4),
            'number_wallet' => $this->faker->unique()->creditCardNumber(),
            'type_wallet' => $this->faker->text(7),
            'validate' => $this->faker->date()
        ];
    }

}
