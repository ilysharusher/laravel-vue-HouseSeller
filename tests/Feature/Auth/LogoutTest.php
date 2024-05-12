<?php

namespace Auth;

use App\Http\Controllers\Auth\LogoutController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function signIn(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }
    public function test_user_can_logout()
    {
        $this->withExceptionHandling();

        $this->signIn();

        $this->post(route('logout'))
            ->assertRedirect(route('listing.index'))
            ->assertSessionHas('success');

        $this->assertGuest();
    }
}
