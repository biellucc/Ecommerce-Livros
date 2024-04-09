<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wallet::factory(7)->create();
    }
}
