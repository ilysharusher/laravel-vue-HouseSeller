<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use App\Models\Listing;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class);
    }

    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia(
            'Listing/Index',
            [
                'filters' => request()->only('priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'),
                'listings' => Listing::query()
                    ->latest()
                    ->listingFilter()
                    ->withoutSold()
                    ->paginate(9)
                    ->withQueryString(),
            ]
        );
    }

    public function show(Listing $listing): \Inertia\Response|\Inertia\ResponseFactory
    {
        $listing->load('images');
        $offerMade = auth()->check() ? $listing->offers()->offer()->first() : null;

        return inertia(
            'Listing/Show',
            [
                'listing' => $listing,
                'offerMade' => $offerMade,
            ]
        );
    }
}
