<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia(
            'Listing/Index',
            [
                'listings' => Listing::all()
            ]
        );
    }

    public function create(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Listing/Create');
    }

    public function store(StoreListingRequest $request): \Illuminate\Http\RedirectResponse
    {
        Listing::query()->create($request->validated());

        return redirect()->route('listing.index')
                         ->with('success', 'Listing created successfully.');
    }

    public function show(Listing $listing): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia(
            'Listing/Show',
            [
                'listing' => $listing
            ]
        );
    }

    public function edit(Listing $listing): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia(
            'Listing/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    public function update(UpdateListingRequest $request, Listing $listing): \Illuminate\Http\RedirectResponse
    {
        $listing->update($request->validated());

        return redirect()->route('listing.index')
                         ->with('success', 'Listing updated successfully.');
    }

    public function destroy(Listing $listing)
    {
        //
    }
}
