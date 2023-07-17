<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{
    Book, Customer, Buy_customer_book
};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buy_customer_book>
 */
class Buy_customer_bookFactory extends Factory
{
    protected $model = Buy_customer_book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'books_id' => Book::factory()->create()->id,
            'customers_id' => Customer::factory()->create()->users_id,
        ];
    }
}
