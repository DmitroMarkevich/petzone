<?php

namespace Tests\Traits;

use App\Models\User;
use App\Models\Advert\Advert;
use App\Models\Advert\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

trait CreatesAdvert
{
    use RefreshDatabase;

    protected function createAdvert(?User $user = null, ?Category $category = null, array $overrides = []): Advert
    {
        return Advert::factory()->create($this->generateAdvertBaseData($user, $category, $overrides));
    }

    protected function makeAdvertData(?User $user = null, ?Category $category = null, array $overrides = []): array
    {
        $data = $this->generateAdvertBaseData($user, $category, $overrides);
        $data['images'] = $this->makeAdvertImages();

        return $data;
    }

    private function generateAdvertBaseData(?User $user = null, ?Category $category = null, array $overrides = []): array
    {
        $category ??= Category::factory()->create();

        $baseData = [
            'title' => 'Test Advert #' . fake()->unique()->numberBetween(1, 99999),
            'description' => str_repeat('Great advert description. ', 3),
            'price' => fake()->numberBetween(100, 5000),
            'category_id' => $category->id,
            'owner_id' => $user?->id ?? User::factory()->create()->id,
        ];

        return array_merge($baseData, $overrides);
    }

    protected function makeAdvertImages(): array
    {
        Storage::fake('public');

        return [
            UploadedFile::fake()->image('test1.jpg'),
            UploadedFile::fake()->image('test2.jpg'),
        ];
    }
}
