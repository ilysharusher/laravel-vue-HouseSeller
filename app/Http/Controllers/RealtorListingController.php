<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listing\StoreRequest;
use App\Http\Requests\Listing\UpdateRequest;
use App\Models\Listing;
use Illuminate\Http\Request;

class RealtorListingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->authorizeResource(Listing::class);
    }

    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Realtor/Index',
        [
            'filters' => request()->only('drafts', 'deleted', 'by', 'order'),
            'listings' => auth()->user()->listings()->realtorFilter()->paginate(9)->withQueryString()
        ]);
    }

    public function create(): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('Realtor/Create');
    }

    public function store(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->user()->listings()->create($request->validated());

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing created successfully.');
    }

    public function show(Listing $listing): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia(
            'Realtor/Show',
            [
                'listing' => $listing
            ]
        );
    }

    public function edit(Listing $listing): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia(
            'Realtor/Edit',
            [
                'listing' => $listing
            ]
        );
    }

    public function update(UpdateRequest $request, Listing $listing): \Illuminate\Http\RedirectResponse
    {
        $listing->update($request->validated());

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing updated successfully.');
    }

    public function destroy(Listing $listing): \Illuminate\Http\RedirectResponse
    {
        $listing->delete();

        return redirect()->back()
            ->with('success', 'Listing deleted successfully.');
    }

    public function restore(Listing $listing): \Illuminate\Http\RedirectResponse
    {
        $listing->restore();

        return redirect()->back()
            ->with('success', 'Listing restored successfully.');
    }
}
