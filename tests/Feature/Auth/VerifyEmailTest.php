<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class VerifyEmailTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Event::fake();
        Notification::fake();

        $this->withExceptionHandling();
    }

    public function signIn(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

    public function test_verification_notice_page_can_be_rendered()
    {
        $this->signIn();

        $this->get(
            action([VerifyEmailController::class, 'verification_notice'])
        )
            ->assertOk();
    }

    public function test_verification_email_can_be_sent()
    {
        $user = $this->signIn();

        $this->post(
            action([VerifyEmailController::class, 'send_verification_email'])
        )
            ->assertRedirect()
            ->assertSessionHas('success');

        Notification::assertSentTo(
            $user,
            VerifyEmail::class
        );
    }

    public function test_email_can_be_verified()
    {
        $user = $this->signIn();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification())
            ]
        );

        $this->get($verificationUrl)
            ->assertRedirect(route('listing.index'))
            ->assertSessionHas('success');

        Event::assertDispatched(Verified::class);

        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }
}
