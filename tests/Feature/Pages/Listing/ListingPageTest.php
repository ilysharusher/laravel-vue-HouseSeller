<?php

namespace Pages\Listing;

use App\Http\Controllers\Listing\ListingController;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ListingPageTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->withExceptionHandling();
    }

    public function test_listing_page_can_be_rendered(): void
    {
        $this->get(
            action([ListingController::class, 'index'])
        )
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Listing/Index')
                    ->has('filters')
                    ->has('listings')
            );
    }

    public function test_listing_show_page_can_be_rendered(): void
    {
        $listing = Listing::factory()->for(
            User::factory()
        )->create();

        $this->get(
            action([ListingController::class, 'show'], $listing)
        )
            ->assertOk()
            ->assertInertia(
                fn (Assert $page) => $page
                    ->component('Listing/Show')
                    ->has('listing')
                    ->has('offerMade')
            );
    }
}
