<?php

namespace Database\Seeders;

use App\Models\Advert\Advert;
use Illuminate\Database\Seeder;

class AdvertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Advert::factory()->count(1000)->create();
    }
}
