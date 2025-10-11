<?php

namespace AdvertManagement;

use App\Models\User;
use Tests\TestCase;
use Tests\Traits\CreatesAdvert;

class PreviewAdvertTest extends TestCase
{
    use CreatesAdvert;

    public function test_preview_page_loads_correctly(): void
    {
        $user = User::factory()->create();

        $data = $this->makeAdvertData($user);

        $response = $this->actingAs($user)
            ->post(route('advert.preview'), $data);

        $response->assertStatus(200);
        $response->assertViewHas('advert');
        $response->assertViewIs('advert.preview');
    }
}
