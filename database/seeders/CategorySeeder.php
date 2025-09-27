<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->delete();

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $parentCategories = [
            'dogs' => 'Для Собак',
            'cats' => 'Для Котів',
            'rodents' => 'Для Гризунів',
            'birds' => 'Для Птахів',
            'fish' => 'Для Риб',
            'reptiles' => 'Для Рептилій',
            'general' => 'Загальні Товари',
            'other' => 'Інші Товари',
        ];

        $parentIds = [];
        foreach ($parentCategories as $slug => $name) {
            $parentIds[$slug] = Str::uuid()->toString();
        }

        $subcategories = [
            'dogs' => [
                ['name' => 'Корм для собак', 'slug' => 'dog-food'],
                ['name' => 'Іграшки для собак', 'slug' => 'dog-toys'],
                ['name' => 'Аксесуари для собак', 'slug' => 'dog-accessories'],
                ['name' => 'Вітаміни та добавки для собак', 'slug' => 'dog-supplements'],
            ],
            'cats' => [
                ['name' => 'Корм для котів', 'slug' => 'cat-food'],
                ['name' => 'Іграшки для котів', 'slug' => 'cat-toys'],
                ['name' => 'Аксесуари для котів', 'slug' => 'cat-accessories'],
            ],
            'rodents' => [
                ['name' => 'Корм для гризунів', 'slug' => 'rodent-food'],
                ['name' => 'Іграшки для гризунів', 'slug' => 'rodent-toys'],
                ['name' => 'Клітки та аксесуари', 'slug' => 'rodent-cages'],
            ],
            'birds' => [
                ['name' => 'Корм для птахів', 'slug' => 'bird-food'],
                ['name' => 'Клітки та годівниці', 'slug' => 'bird-cages'],
                ['name' => 'Іграшки для птахів', 'slug' => 'bird-toys'],
            ],
            'fish' => [
                ['name' => 'Корм для риб', 'slug' => 'fish-food'],
                ['name' => 'Акваріуми', 'slug' => 'aquariums'],
                ['name' => 'Аксесуари для акваріумів', 'slug' => 'fish-accessories'],
            ],
            'reptiles' => [
                ['name' => 'Корм для рептилій', 'slug' => 'reptile-food'],
                ['name' => 'Терраріуми', 'slug' => 'terrariums'],
                ['name' => 'Аксесуари для рептилій', 'slug' => 'reptile-accessories'],
            ],
            'general' => [
                ['name' => 'Вітаміни та добавки', 'slug' => 'general-supplements'],
                ['name' => 'Косметика та гігієна', 'slug' => 'general-hygiene'],
                ['name' => 'Іграшки', 'slug' => 'general-toys'],
            ],
            'other' => [
                ['name' => 'Одяг та аксесуари', 'slug' => 'other-clothes'],
                ['name' => 'Подарункові набори', 'slug' => 'other-gifts'],
            ],
        ];

        $insertData = [];
        foreach ($parentCategories as $slug => $name) {
            $insertData[] = [
                'id' => $parentIds[$slug],
                'parent_id' => null,
                'name' => $name,
                'slug' => $slug,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        foreach ($subcategories as $parentSlug => $subs) {
            foreach ($subs as $sub) {
                $insertData[] = [
                    'id' => Str::uuid()->toString(),
                    'parent_id' => $parentIds[$parentSlug],
                    'name' => $sub['name'],
                    'slug' => $sub['slug'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        DB::table('categories')->insert($insertData);
    }
}
