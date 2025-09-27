<?php

namespace Database\Factories\Advert;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advert\Category>
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [];
    }

    public function withData(string $name, ?string $parentId = null): static
    {
        return $this->state(fn () => [
            'name' => $name,
            'slug' => Str::slug($name),
            'parent_id' => $parentId,
        ]);
    }
}
