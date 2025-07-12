<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RestoreTrashedDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::onlyTrashed()->restore();
        Product::onlyTrashed()->restore();
    }
}