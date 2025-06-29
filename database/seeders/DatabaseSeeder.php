<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\PromotionImage;
use App\Models\ProductSize;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Seed Users
        User::create([
            'nik' => '1234567890',
            'name' => 'Trallalelo Trallala',
            'birth_date' => '1990-01-01',
            'phone' => '081234567890',
            'email' => 'trallalelo@gmail.com',
            'address' => 'Jl. Trallalelo No. 1, Trallala',
            'role' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'nik' => '1234567891',
            'name' => 'Ballerina Cappucina',
            'birth_date' => '2002-02-02',
            'phone' => '081234567890',
            'email' => 'Ballerina@gmail.com',
            'address' => 'Jl. Ballerina No. 2, Cappucina',
            'role' => 'User',
            'username' => 'user',
            'password' => bcrypt('password'),
        ]);

        // Seed Categories
        // $categories = [
        //     ['category_name' => 'T-Shirt', 'category_slug' => 't-shirt'],
        //     ['category_name' => 'Hoodie', 'category_slug' => 'hoodie'],
        //     ['category_name' => 'Helmet', 'category_slug' => 'helmet'],
        //     ['category_name' => 'Jacket', 'category_slug' => 'jacket'],
        //     ['category_name' => 'Sweater', 'category_slug' => 'sweater'],
        //     ['category_name' => 'Glove', 'category_slug' => 'glove'],
        //     ['category_name' => 'Hoodie', 'category_slug' => 'hoodie'], 
        // ];

        // foreach ($categories as $category) {
        //     Category::create($category);
        // }

    }
}
