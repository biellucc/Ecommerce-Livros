<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Cart;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carts = Cart::all();
        $books = Book::all();

        foreach($carts as $cart){
            $randomBooks = $books->random(rand(1,4));

            $cart->books()->attach($randomBooks);
        }
    }
}
