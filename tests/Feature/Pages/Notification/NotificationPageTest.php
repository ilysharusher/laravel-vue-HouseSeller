<?php

namespace Tests\Feature\Pages\Notification;

use App\Http\Controllers\Listing\ListingOfferController;
use App\Http\Controllers\Notification\NotificationController;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\RequestFactories\StoreListingRequestFactory;
use Tests\TestCase;

class NotificationPageTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Listing $listing;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
        //        Notification::fake(); // The fake method is not working as expected

        $this->user = $this->signIn();
        $this->listing = $this->createListing($this->user);

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

    private function createListing(User $user): Listing
    {
        return $user->listings()->create(
            StoreListingRequestFactory::new()->create()
        );
    }

    private function createNotification(User $user): void
    {
        $anotherUser = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $this->actingAs($anotherUser)->post(
            action([ListingOfferController::class, 'store'], $this->listing),
            [
                'price' => 100,
            ]
        );

        $this->actingAs($user);
    }

    public function test_unauthenticated_user_cannot_access_notification_page(): void
    {
        Auth::logout();

        $this->get(
            action([NotificationController::class, 'index'])
        )
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_access_notification_page(): void
    {
        $this->get(
            action([NotificationController::class, 'index'])
        )
            ->assertOk();
    }

    public function test_user_can_mark_notification_as_read(): void
    {
        $this->createNotification($this->user);

        $notification = $this->listing->user->notifications()->first();

        $this->patch(
            route(
                'mark.notification.as.read',
                $notification
            )
        )
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertTrue($notification->fresh()->read());
    }

    public function test_user_can_delete_all_notifications(): void
    {
        $this->createNotification($this->user);

        $this->delete(
            route('notification.destroy_all')
        )
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertCount(0, $this->user->notifications);
    }
}
