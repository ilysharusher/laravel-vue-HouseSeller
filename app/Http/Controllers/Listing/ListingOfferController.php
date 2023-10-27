<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\StoreListingOfferRequest;
use App\Models\Listing;
use App\Models\Offer;
use App\Notifications\OfferMade;

class ListingOfferController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Offer::class);
    }

    public function store(Listing $listing, StoreListingOfferRequest $request): \Illuminate\Http\RedirectResponse
    {
        $offer = $listing->offers()->create([
            'bidder_id' => auth()->id(),
            'price' => $request->price,
        ]);

        $listing->user->notify(new OfferMade($offer));

        return redirect()->back()
            ->with('success', 'Offer created successfully');
    }
}
