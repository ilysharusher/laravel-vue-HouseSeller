<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use App\Http\Requests\StoreListingImageRequest;
use App\Http\Requests\UpdateListingImageRequest;

class ListingImageController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Listing $listing): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia(
            'Realtor/ListingImage/Create',
            ['listing' => $listing]
        );
    }

    public function store(StoreListingImageRequest $request)
    {
        //
    }

    public function show(ListingImage $listingImage)
    {
        //
    }

    public function edit(ListingImage $listingImage)
    {
        //
    }

    public function update(UpdateListingImageRequest $request, ListingImage $listingImage)
    {
        //
    }

    public function destroy(ListingImage $listingImage)
    {
        //
    }
}
