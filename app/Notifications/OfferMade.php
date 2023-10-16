<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferMade extends Notification
{
    use Queueable;

    public function __construct(
        private readonly Offer $offer
    ) {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'offer_id' => $this->offer->id,
            'listing_id' => $this->offer->listing_id,
            'bidder_id' => $this->offer->bidder_id,
            'offer_price' => $this->offer->price,
        ];
    }
}
