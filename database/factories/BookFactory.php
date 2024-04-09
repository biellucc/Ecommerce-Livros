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
        return  [
            'title' => $this->faker->word(),
            'summary' => $this->faker->paragraph(),
            'pages' => $this->faker->numberBetween(1, 3000),
            'author' => $this->faker->name(),
            'amount' => $this->faker->numberBetween(1, 1000),
            'value' => $this->faker->randomFloat(2, 1, 10000),
            'vendor_id' => Vendor::pluck('id')->random(),
            'image' => $this->faker->imageUrl(),
            'isbn13' => $this->faker->isbn13(),
            'language' => $this->faker->languageCode(),
            'edition' => $this->faker->numberBetween(1, 20),
            'publishing_company' => $this->faker->company(),
            'dimension' => $this->faker->text(5),
            'publication_date' => $this->faker->date(),
            'parental_rating' => $this->faker->numberBetween(5, 18),
            'type' => $this->faker->randomElement(['fantasia', 'educação', 'ação', 'cultura'])
        ];
    }

}
