<?php

namespace AdvertManagement;

use Tests\TestCase;
use App\Models\User;
use Tests\Traits\CreatesAdvert;

class UpdateAdvertTest extends TestCase
{
    use CreatesAdvert;

    public function test_authorized_user_can_update_advert(): void
    {
        $user = User::factory()->create();

        $advert = $this->createAdvert($user);
        $data = $this->makeAdvertData($user);

        $response = $this->actingAs($user)
            ->put(route('advert.update', $advert->id), $data);

        $response->assertRedirect(route('profile.advert'));
    }

    public function test_non_owner_cannot_update_advert(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $advert = $this->createAdvert($owner);
        $data = $this->makeAdvertData($owner);

        $response = $this->actingAs($otherUser)
            ->put(route('advert.update', $advert->id), $data);

        $response->assertForbidden();
    }
}
