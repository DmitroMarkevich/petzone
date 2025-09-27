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
        return [
            'id'         => Str::uuid()->toString(),
            'name'       => $this->faker->word(),
            'slug'       => $this->faker->slug(),
            'parent_id'  => null,
            'position'   => 0,
        ];
    }

    public function withParent(string $parentId, int $position = 0): static
    {
        return $this->state(fn () => [
            'id'        => Str::uuid()->toString(),
            'parent_id' => $parentId,
            'position'  => $position,
        ]);
    }

    public function withData(array $data, ?string $parentId = null, int $position = 0): static
    {
        return $this->state(fn () => [
            'id'         => Str::uuid()->toString(),
            'parent_id'  => $parentId,
            'name'       => $data['name'],
            'slug'       => $data['slug'],
            'position'   => $position,
        ]);
    }
}
