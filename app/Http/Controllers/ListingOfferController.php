<?php

namespace App\Http\Controllers;

use App\Http\Requests\Offer\StoreListingOfferRequest;
use App\Http\Requests\Offer\UpdateListingOfferRequest;
use App\Models\Listing;
use App\Models\Offer;

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
        $listing->offers()->create([
            'user_id' => auth()->id(),
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Offer created successfully');
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
