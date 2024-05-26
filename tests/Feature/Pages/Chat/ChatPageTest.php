<?php

namespace Tests\Feature\Pages\Chat;

use App\Http\Controllers\Chat\ChatController;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\RequestFactories\StoreListingRequestFactory;
use Tests\TestCase;

class ChatPageTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Listing $listing;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        $this->user = $this->signIn();
        $this->listing = $this->createListing();

        $this->withExceptionHandling();
    }

    private function signIn(): User
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($user);

        return $user;
    }

    private function createListing(): \Illuminate\Database\Eloquent\Model|Listing
    {
        return $this->user->listings()->create(
            StoreListingRequestFactory::new()->create()
        );
    }

    public function test_chat_page_can_be_rendered()
    {
        $this->get(
            action([ChatController::class, 'index'])
        )
            ->assertOk()
            ->assertInertia(
                (fn (Assert $assert) => $assert
                    ->component('Chat/Index')
                    ->has('chats')
                )
            );
    }

    public function test_chat_page_can_not_be_rendered_for_guests()
    {
        Auth::logout();

        $this->get(
            action([ChatController::class, 'index'])
        )
            ->assertRedirect(route('login'));
    }

    public function test_user_can_create_chat()
    {
        $anotherUser = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($anotherUser);

        $this->post(
            action([ChatController::class, 'store']),
            [
                'user' => $this->listing->user->id,
                'listing_id' => $this->listing->id,
            ]
        )
            ->assertRedirect(route('chats.show', 1));

        $this->assertDatabaseHas('chats', [
            'users' => $this->user->id . '-' . $anotherUser->id,
            'listing_id' => $this->listing->id,
        ]);

        $this->assertDatabaseHas('chat_user', [
            'chat_id' => 1,
            'user_id' => $this->user->id,
        ]);
    }

    public function test_user_can_not_create_chat_with_himself()
    {
        $this->post(
            action([ChatController::class, 'store']),
            [
                'user' => $this->user->id,
                'listing_id' => $this->listing->id,
            ]
        )
            ->assertForbidden();
    }
}
