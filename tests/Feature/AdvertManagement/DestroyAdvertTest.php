<?php

namespace AdvertManagement;

use App\Models\User;
use Tests\TestCase;
use Tests\Traits\CreatesAdvert;

class DestroyAdvertTest extends TestCase
{
    use CreatesAdvert;

    public function test_owner_can_destroy_advert(): void
    {
        $user = User::factory()->create();
        $advert = $this->createAdvert($user);

        $response = $this->actingAs($user)
            ->delete(route('advert.destroy', $advert));

        $response->assertRedirect(route('profile.advert'));

        $this->assertDatabaseMissing('adverts', [
            'id' => $advert->id,
        ]);
    }

    public function test_non_owner_cannot_destroy_advert(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $advert = $this->createAdvert($owner);

        $response = $this->actingAs($otherUser)
            ->delete(route('advert.destroy', $advert));

        $response->assertForbidden();

        $this->assertDatabaseHas('adverts', [
            'id' => $advert->id,
        ]);
    }
}
