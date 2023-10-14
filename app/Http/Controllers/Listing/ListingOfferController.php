<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\StoreListingOfferRequest;
use App\Models\Listing;

class ListingOfferController extends Controller
{
    /*public function index()
    {
        //
    }

    public function create()
    {
        //
    }*/

    public function store(Listing $listing, StoreListingOfferRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('view', $listing);

        $listing->offers()->create([
            'bidder_id' => auth()->id(),
            'price' => $request->price,
        ]);

        return redirect()->back()
            ->with('success', 'Offer created successfully');
    }

    /*public function show(Offer $listingOffer)
    {
        //
    }

    public function edit(Offer $listingOffer)
    {
        //
    }

    public function update(UpdateListingOfferRequest $request, Offer $listingOffer)
    {
        //
    }

    public function destroy(Offer $listingOffer)
    {
        //
    }*/
}
