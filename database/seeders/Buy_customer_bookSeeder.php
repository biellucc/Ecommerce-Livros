<?php

namespace Database\Seeders;

use App\Models\Buy_customer_book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Buy_customer_bookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buy_customer_book::factory()->count(10)->create();
    }
}
