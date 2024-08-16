<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Notification::fake();

        $this->withExceptionHandling();
    }

    private function password_email(): User
    {
        $user = User::factory()->create();

        $this->post(
            action([ForgotPasswordController::class, 'password_email']),
            ['email' => $user->email]
        )
            ->assertSessionHas('success')
            ->assertRedirect(route('login'));

        return $user;
    }

    public function test_password_request_page_can_be_rendered(): void
    {
        $this->get(
            action([ForgotPasswordController::class, 'password_request'])
        )
            ->assertOk();
    }

    public function test_password_email_can_be_sent(): void
    {
        $user = $this->password_email();

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_password_reset_page_can_be_rendered(): void
    {
        $user = $this->password_email();

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
            $this->get(
                action([ForgotPasswordController::class, 'password_reset'], $notification->token)
            )
                ->assertOk();

            return true;
        });
    }

    public function test_password_can_be_updated(): void
    {
        $user = $this->password_email();

        Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
            $this->post(
                action([ForgotPasswordController::class, 'password_update']),
                [
                    'token' => $notification->token,
                    'email' => $user->email,
                    'password' => 'new-password',
                    'password_confirmation' => 'new-password',
                ]
            )
                ->assertSessionHas('success')
                ->assertRedirect(route('login'));

            return true;
        });
    }
}
