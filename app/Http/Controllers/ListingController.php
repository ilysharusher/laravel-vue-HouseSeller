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

        $this->authorizeResource(Listing::class, 'listing');
    }

    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia(
            'Listing/Index',
            [
                'filters' => request()->only('priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo'),
                'listings' => Listing::query()
                    ->orderByDesc('created_at')
                    ->when(
                        request()->filled('priceFrom'),
                        fn($query) => $query->where('price', '>=', request('priceFrom'))
                    )->when(
                        request()->filled('priceTo'),
                        fn($query) => $query->where('price', '<=', request('priceTo'))
                    )->when(
                        request()->filled('beds'),
                        fn($query) => $query->where('beds', (int)request('beds') <= 5 ? '=' : '>=', request('beds'))
                    )->when(
                        request()->filled('baths'),
                        fn($query) => $query->where('baths', (int)request('baths') <= 5 ? '=' : '>=', request('baths'))
                    )->when(
                        request()->filled('areaFrom'),
                        fn($query) => $query->where('area', '>=', request('areaFrom'))
                    )->when(
                        request()->filled('areaTo'),
                        fn($query) => $query->where('area', '<=', request('areaTo'))
                    )->paginate(9)->withQueryString()
            ]
        );
    }

    public function create(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Listing/Create');
    }

    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->user()->listings()->create($request->validated());

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
