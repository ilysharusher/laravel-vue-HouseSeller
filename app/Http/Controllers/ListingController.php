<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\StoreRequest;
use App\Http\Requests\Listing\UpdateRequest;
use App\Models\Listing;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->except(['index', 'show']);
    }

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

    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
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

    public function update(UpdateRequest $request, Listing $listing): \Illuminate\Http\RedirectResponse
    {
        $listing->update($request->validated());

        return redirect()->route('listing.index')
            ->with('success', 'Listing updated successfully.');
    }

    public function destroy(Listing $listing): \Illuminate\Http\RedirectResponse
    {
        $listing->delete();

        return redirect()->back()
            ->with('success', 'Listing deleted successfully.');
    }
}
