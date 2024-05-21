<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Listing\ListingImage\StoreListingImageRequest;
use App\Http\Requests\Listing\ListingImage\UpdateListingImageRequest;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Support\Facades\Storage;

class ListingImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('verify.image.upload')->only('store');
    }

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
        foreach ($request->file('images') as $image) {
            $path = $image->store('images', 'public');

            $listing->images()->create([
                'image' => $path,
            ]);
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

    public function destroy($listing, ListingImage $image): \Illuminate\Http\RedirectResponse
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return redirect()->back()->with('success', 'The image was deleted!');
    }

    public function destroy_all(Listing $listing): \Illuminate\Http\RedirectResponse
    {
        Storage::disk('public')->delete($listing->images()->pluck('image')->toArray());

        $listing->images()->delete();

        return redirect()->back()->with('success', 'All images were deleted!');
    }
}
