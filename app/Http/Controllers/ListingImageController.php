<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\ListingImage\StoreListingImageRequest;
use App\Http\Requests\Listing\ListingImage\UpdateListingImageRequest;
use App\Models\Listing;
use App\Models\ListingImage;

class ListingImageController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Listing $listing): \Inertia\Response|\Inertia\ResponseFactory
    {
        $listing->load('images');
        return inertia(
            'Realtor/ListingImage/Create',
            ['listing' => $listing]
        );
    }

    public function store(Listing $listing, StoreListingImageRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (request()->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('images');

                $listing->images()->create([
                    'image' => $path
                ]);
            }
        }

        return redirect()->back()->with('success', 'The images were uploaded!');
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
