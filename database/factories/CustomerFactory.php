<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\{
    User, Customer
};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'cpf' => $this->faker->randomNumber(9, true),
            'user_id' => User::pluck('id')->random(),
            'firstName' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'gender'=> $this->faker->randomElement(['Feminino', 'Masculino']),
            'birthday' => $this->faker->date('y_m_d')
        ];
    }
}
