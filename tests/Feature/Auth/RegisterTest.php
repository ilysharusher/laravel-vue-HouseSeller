<?php

namespace Tests\Feature\Auth;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\RequestFactories\RegisterRequestFactory;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    public function test_register_page_can_be_rendered()
    {
        $this->get(
            action([RegisterController::class, 'register'])
        )
            ->assertOk();
    }

    public function test_user_can_register()
    {
        Event::fake();

        $data = RegisterRequestFactory::new()->create();

        $this->post(
            action([RegisterController::class, 'register_store']),
            $data
        )
            ->assertValid()
            ->assertRedirect(route('listing.index'));

        Event::assertDispatched(Registered::class, function ($event) use ($data) {
            return $event->user->email === $data['email'];
        });

        Event::assertListening(
            Registered::class,
            SendEmailVerificationNotification::class
        );

        $this->assertDatabaseHas(
            User::class,
            [
                'email' => $data['email'],
            ]
        )
            ->assertAuthenticated();
    }
}
