<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        // Seed Roles
        DB::table('role')->insert([
            ['role' => 'Admin'],
            ['role' => 'User'],
        ]);

        // Seed Users
        DB::table('user')->insert([
            [
                'nama' => 'Bowdown Admin',
                'tanggal_lahir' => '1990-01-01',
                'no_hp' => '081234567890',
                'email' => 'bowdownadmin@gmail.com',
                'password' => Hash::make('password'),
                'id_role' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Bowdown User',
                'tanggal_lahir' => '2002-02-02',
                'no_hp' => '081234567890',
                'email' => 'bowdownuser@gmail.com',
                'password' => Hash::make('password'),
                'id_role' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
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
