<?php

namespace Tests\Feature\Pages\Listing;

use App\Http\Controllers\Listing\ListingOfferController;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\RequestFactories\StoreListingRequestFactory;
use Tests\TestCase;

class ListingOfferTest extends TestCase
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

    private function createListing(): Model|Listing
    {
        return $this->user->listings()->create(
            StoreListingRequestFactory::new()->create()
        );
    }

    public function test_guests_cannot_make_an_offer(): void
    {
        Auth::logout();
        $this->assertGuest();

        $this->post(
            action([ListingOfferController::class, 'store'], $this->listing),
            [
                'price' => 100,
            ]
        )
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_make_an_offer(): void
    {
        $anotherUser = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($anotherUser);

        $this->post(
            action([ListingOfferController::class, 'store'], $this->listing),
            [
                'price' => 100,
            ]
        )
            ->assertRedirect()
            ->assertSessionHas('success');
    }

    public function test_guests_cannot_accept_an_offer(): void
    {
        $anotherUser = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($anotherUser);

        $this->post(
            action([ListingOfferController::class, 'store'], $this->listing),
            [
                'price' => 100,
            ]
        );

        $this->assertDatabaseCount('offers', 1);

        Auth::logout();
        $this->assertGuest();

        $this->patch(
            route('realtor.offer.accept', $this->listing->offers->first())
        )
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_accept_an_offer(): void
    {
        $anotherUser = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($anotherUser);

        $this->post(
            action([ListingOfferController::class, 'store'], $this->listing),
            [
                'price' => 100,
            ]
        );

        $this->assertDatabaseCount('offers', 1);

        $this->actingAs($this->user);

        $this->patch(
            route('realtor.offer.accept', $this->listing->offers->first())
        )
            ->assertRedirect()
            ->assertSessionHas('success');
    }
}
