<?php

namespace AdvertManagement;

use App\Models\User;
use App\Models\Advert\Advert;
use App\Models\Advert\Category;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Tests\Traits\CreatesAdvert;
use Meilisearch\Client;

class IndexAdvertTest extends TestCase
{
    use CreatesAdvert;

    private User $user;
    private Category $category;
    private Client $meilisearchClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->category = Category::factory()->create();

        $this->meilisearchClient = new Client(
            config('scout.meilisearch.host'),
            config('scout.meilisearch.key')
        );
        $this->meilisearchClient->index((new Advert())->searchableAs())->deleteAllDocuments();
    }

    private function createAndIndexAdverts(array $advertsData): Collection
    {
        $adverts = collect($advertsData)
            ->map(fn($data) => $this->createAdvert($this->user, $this->category, $data));

        $this->indexAdvertsInMeilisearch($adverts);

        return $adverts;
    }

    public function test_search_returns_matching_adverts()
    {
        $titleToSearch = 'UniqueTitleSearch' . uniqid();

        $this->createAndIndexAdverts([
            ['title' => $titleToSearch, 'price' => 100],
            ['title' => 'Other Advert', 'price' => 200],
        ]);

        $response = $this->actingAs($this->user)->get(route('advert.index', [
            'query' => $titleToSearch,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('advert.index');
        $response->assertViewHas('adverts', fn($adverts) => $adverts->contains('title', $titleToSearch));
    }

    public function test_filter_by_price_range()
    {
        $this->createAndIndexAdverts([
            ['title' => 'A', 'price' => 100],
            ['title' => 'B', 'price' => 200],
            ['title' => 'C', 'price' => 300],
        ]);

        $response = $this->actingAs($this->user)->get(route('advert.index', [
            'price_min' => 150,
            'price_max' => 250,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('advert.index');
        $response->assertViewHas('adverts', fn($adverts) =>
            $adverts->every(fn($advert) => $advert->price >= 150 && $advert->price <= 250)
        );
    }

    public function test_sort_by_price_ascending()
    {
        $this->assertPriceSorting('price-asc', [100, 200, 300]);
    }

    public function test_sort_by_price_descending()
    {
        $this->assertPriceSorting('price-desc', [300, 200, 100]);
    }

    private function assertPriceSorting(string $sort, array $expectedOrder): void
    {
        $this->createAndIndexAdverts([
            ['title' => 'A', 'price' => 300],
            ['title' => 'B', 'price' => 100],
            ['title' => 'C', 'price' => 200],
        ]);

        $response = $this->actingAs($this->user)->get(route('advert.index', [
            'sort' => $sort,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('advert.index');
        $response->assertViewHas('adverts', function ($adverts) use ($expectedOrder) {
            $prices = $adverts->pluck('price')->toArray();
            return array_map('floatval', $prices) === array_map('floatval', $expectedOrder);
        });
    }

    private function indexAdvertsInMeilisearch(Collection $adverts): void
    {
        $index = $this->meilisearchClient->index($adverts->first()->searchableAs());
        $task = $index->addDocuments($adverts->map->toSearchableArray()->all(), 'id');
        $index->waitForTask($task['taskUid']);
    }
}
