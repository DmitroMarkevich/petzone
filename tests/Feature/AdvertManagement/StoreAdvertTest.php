<?php

namespace AdvertManagement;

use App\Models\User;
use Tests\TestCase;
use Tests\Traits\CreatesAdvert;

class StoreAdvertTest extends TestCase
{
    use CreatesAdvert;

    public function test_user_can_create_advert(): void
    {
        $user = User::factory()->create();

        $data = $this->makeAdvertData($user);

        $response = $this->actingAs($user)
            ->post(route('advert.store'), $data);

        $response->assertRedirect();
        $response->assertRedirect(route('profile.advert'));

        $this->assertDatabaseHas('adverts', [
            'title' => $data['title'],
            'owner_id' => $user->id,
        ]);
    }
}
