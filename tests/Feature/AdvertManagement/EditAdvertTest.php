<?php

namespace AdvertManagement;

use App\Models\User;
use Tests\TestCase;
use Tests\Traits\CreatesAdvert;

class EditAdvertTest extends TestCase
{
    use CreatesAdvert;

    public function test_owner_can_access_edit_page(): void
    {
        $user = User::factory()->create();

        $advert = $this->createAdvert($user);

        $response = $this->actingAs($user)
            ->get(route('advert.edit', $advert));

        $response->assertStatus(200);
        $response->assertViewHas('advert');
        $response->assertViewIs('advert.edit');
    }

    public function test_non_owner_cannot_access_edit_page(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $advert = $this->createAdvert($owner);

        $response = $this->actingAs($otherUser)
            ->get(route('advert.edit', $advert));

        $response->assertForbidden();
    }
}
