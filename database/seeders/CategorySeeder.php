<?php

namespace Database\Seeders;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => Uuid::uuid4(),
                'name' => 'Для собак',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => Uuid::uuid4(),
                'name' => 'Для котів',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
