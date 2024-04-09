<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vendor;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *s
     * @return void
     */
    public function run()
    {
        User::factory(20)->create();
    }
}
