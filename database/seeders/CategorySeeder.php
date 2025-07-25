<?php

namespace Database\Seeders;

use App\Models\Advert\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(10)->create();
        Category::factory()->count(50)->create();
    }
}
