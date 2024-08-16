<?php

namespace Pages\Listing;

use App\Http\Controllers\Realtor\ListingImageController;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\RequestFactories\StoreListingImageRequestFactory;
use Tests\RequestFactories\StoreListingRequestFactory;
use Tests\TestCase;

class ListingImageTest extends TestCase
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

    public function test_listing_image_page_can_be_rendered(): void
    {
        $this->get(
            action([ListingImageController::class, 'create'], $this->listing->id)
        )
            ->assertOk()
            ->assertInertia(
                fn (Assert $assert) => $assert
                    ->component('Realtor/ListingImage/Create')
                    ->whereAll([
                        'listing.id' => $this->listing->id,
                        'listing.images' => $this->listing->images,
                    ])
            );
    }

    public function test_listing_image_can_be_stored(): void
    {
        $this->post(
            action([ListingImageController::class, 'store'], $this->listing->id),
            StoreListingImageRequestFactory::new()->create()
        )
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertCount(1, $this->listing->refresh()->images);
    }

    public function test_listing_image_can_be_deleted(): void
    {
        $this->post(
            action([ListingImageController::class, 'store'], $this->listing->id),
            StoreListingImageRequestFactory::new()->create()
        )
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->delete(
            action(
                [ListingImageController::class, 'destroy'],
                [$this->listing->id, $this->listing->images->first()->id]
            )
        )
            ->assertRedirect()
            ->assertSessionHas('success');
    }

    public function test_all_listing_images_can_be_deleted(): void
    {
        $this->post(
            action([ListingImageController::class, 'store'], $this->listing->id),
            StoreListingImageRequestFactory::new()->create()
        )
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->delete(
            action([ListingImageController::class, 'destroy_all'], $this->listing->id)
        )
            ->assertRedirect()
            ->assertSessionHas('success');
    }
}
