<?php

namespace Database\Seeders;

use App\Models\Advert\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->delete();

        $categories = require database_path('seeders/data/categories.php');

        foreach ($categories as $position => $category) {
            $this->createCategory($category, null, $position);
        }
    }

    private function createCategory(array $data, ?string $parentId, int $position): void
    {
        $isParent = is_null($parentId);

        $category = Category::factory()
            ->withData($data, $parentId, $isParent ? $position : 0)
            ->create();

        if (!empty($data['children'])) {
            foreach ($data['children'] as $i => $child) {
                $this->createCategory($child, $category->id, $i);
            }
        }
    }
}
