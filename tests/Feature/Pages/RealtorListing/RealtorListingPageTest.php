<?php

namespace Pages\RealtorListing;

use App\Http\Controllers\Realtor\RealtorListingController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\RequestFactories\StoreListingRequestFactory;
use Tests\TestCase;

class RealtorListingPageTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = $this->signIn();

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

    private function createListing(User $user)
    {
        return $user->listings()->create(
            StoreListingRequestFactory::new()->create()
        );
    }

    public function test_realtor_listing_page_can_be_rendered()
    {
        $this->get(
            action([RealtorListingController::class, 'index'])
        )
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Realtor/Index')
                    ->has('filters')
                    ->has('listings')
            );
    }

    public function test_realtor_listing_create_page_can_be_rendered()
    {
        $this->get(
            action([RealtorListingController::class, 'create'])
        )
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Realtor/Create')
            );
    }

    public function test_realtor_store_method_can_store_listing()
    {
        $data = StoreListingRequestFactory::new()->create();

        $this->post(
            action([RealtorListingController::class, 'store']),
            $data
        )
            ->assertRedirect(route('realtor.listing.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('listings', [
            'user_id' => $this->user->id,
            'beds' => $data['beds'],
            'baths' => $data['baths'],
            'area' => $data['area'],
            'city' => $data['city'],
            'code' => $data['code'],
            'street' => $data['street'],
            'street_number' => $data['street_number'],
            'price' => $data['price'],
        ]);
    }

    public function test_realtor_listing_show_page_can_be_rendered()
    {
        $listing = $this->createListing($this->user);

        $this->get(
            action([RealtorListingController::class, 'show'], $listing)
        )
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Realtor/Show')
                    ->has('listing')
            );
    }

    public function test_realtor_listing_edit_page_can_be_rendered()
    {
        $listing = $this->createListing($this->user);

        $this->get(
            action([RealtorListingController::class, 'edit'], $listing)
        )
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Realtor/Edit')
                    ->has('listing')
                    ->has('imagesCount')
            );
    }

    public function test_realtor_listing_update_method_can_update_listing()
    {
        $listing = $this->createListing($this->user);

        $data = StoreListingRequestFactory::new()->create([
            'beds' => 3,
            'baths' => 2,
            'area' => 200
        ]);

        $this->patch(
            action([RealtorListingController::class, 'update'], $listing),
            $data
        )
            ->assertRedirect(route('realtor.listing.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('listings', [
            'id' => $listing->id,
            'user_id' => $this->user->id,
            'beds' => $data['beds'],
            'baths' => $data['baths'],
            'area' => $data['area'],
            'city' => $data['city'],
            'code' => $data['code'],
            'street' => $data['street'],
            'street_number' => $data['street_number'],
            'price' => $data['price'],
        ]);
    }

    public function test_realtor_listing_destroy_method_can_delete_listing()
    {
        $listing = $this->createListing($this->user);

        $this->delete(
            action([RealtorListingController::class, 'destroy'], $listing)
        )
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas(
            'listings',
            [
                'id' => $listing->id,
                'deleted_at' => now()
            ]
        );
    }

    public function test_realtor_listing_destroy_permanently_method_can_delete_listing_permanently()
    {
        $listing = $this->createListing($this->user);

        $this->delete(
            action([RealtorListingController::class, 'destroy_permanently'], $listing)
        )
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseEmpty('listings');
    }

    public function test_realtor_listing_restore_method_can_restore_listing()
    {
        $listing = $this->createListing($this->user);

        $listing->delete();

        $this->patch(
            action([RealtorListingController::class, 'restore'], $listing)
        )
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas(
            'listings',
            [
                'id' => $listing->id,
                'deleted_at' => null
            ]
        );
    }
}
