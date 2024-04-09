<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BookOrder;
use App\Models\Cart;
use App\Models\CartOrder;
use App\Models\Customer;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TransporterSeeder::class,
            UserSeeder::class,
            AddressSeeder::class,
            CustomerSeeder::class,
            WalletSeeder::class,
            VendorSeeder::class,
            BookSeeder::class,
            CommentSeeder::class,
            CartSeeder::class,
            CartBookSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
