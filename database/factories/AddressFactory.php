<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;
use App\Models\User;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cep' => $this->faker->postcode(),
            'neighborhood' => $this->faker->streetName(),
            'n_house' => $this->faker->buildingNumber(),
            'complement' => $this->faker->optional()->text(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'user_id' => User::pluck('id')->random()
        ];
    }
}

