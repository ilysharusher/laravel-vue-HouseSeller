<?php

namespace Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    private function signIn(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

    public function test_user_can_logout(): void
    {
        $this->withExceptionHandling();

        $this->signIn();

        $this->post(route('logout'))
            ->assertRedirect(route('listing.index'))
            ->assertSessionHas('success');

        $this->assertGuest();
    }
}
