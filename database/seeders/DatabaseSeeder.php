<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
        User::create([
            'name' => 'Kristian Smid',
            'email' => 'smid.kristian@gmail.com',
            'password' => Hash::make('dostojevskij')
        ]);

        Category::create([
            'name' => 'Root',
            'description' => 'Root category, do not delete it!'
        ]);

        Brand::factory(10)->create();
        Category::factory(10)->create();
        Product::factory(30)->create();
    }
}
