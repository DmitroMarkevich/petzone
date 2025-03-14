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
        $categories = ['Собаки', 'Коти'];

        foreach ($categories as $category) {
            Category::create(['id' => Str::uuid(), 'name' => $category]);
        }
    }
}
