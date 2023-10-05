<?php

namespace App\Http\Controllers;

use App\Models\Listing;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->except(['index', 'show']);

        $this->authorizeResource(Listing::class, 'listing');
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
                    ->paginate(9)
                    ->withQueryString(),
            ]
        );
    }

    public function show(Listing $listing): \Inertia\Response|\Inertia\ResponseFactory
    {
        $listing->load('images');

        return inertia(
            'Listing/Show',
            [
                'listing' => $listing,
            ]
        );
    }
}
