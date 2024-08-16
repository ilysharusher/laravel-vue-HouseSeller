<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    public function test_login_page_can_be_rendered(): void
    {
        $this->get(
            action([LoginController::class, 'login'])
        )
            ->assertOk();
    }

    public function test_user_can_login(): void
    {
        $user = User::factory()->create();

        $this->post(
            action([LoginController::class, 'login_store']),
            [
                'email' => $user->email,
                'password' => 'password',
            ]
        )
            ->assertRedirect(route('listing.index'))
            ->assertSessionHas('success');

        $this->assertAuthenticated();
    }

    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        $user = User::factory()->create();

        $this->post(
            action([LoginController::class, 'login_store']),
            [
                'email' => $user->email,
                'password' => 'invalid-password',
            ]
        )
            ->assertSessionHasErrors('email');

        $this->assertGuest();
    }
}
