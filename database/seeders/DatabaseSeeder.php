<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Kristian Smid',
            'email' => 'smid.kristian@gmail.com',
            'password' => Hash::make('dostojevskij')
        ]);

        Brand::factory(10)->create();
        Product::factory(30)->create();
    }
}
