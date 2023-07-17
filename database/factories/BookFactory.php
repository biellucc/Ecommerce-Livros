<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\{
    Vendor, Book
};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'summary' => $this->faker->paragraph,
            'pages' => $this->faker->numberBetween(100, 500),
            'author' => $this->faker->name,
            'amount' => $this->faker->numberBetween(1, 10),
            'value' => $this->faker->randomFloat(2, 10, 100),
            'vendor' => Vendor::factory()->create()->users_id,
        ];
    }
}
