<?php

namespace App\Http\Controllers;

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
            'listings' => auth()->user()->listings()->filter()->latest()->get()
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing updated successfully.');
    }

    public function destroy(Listing $listing): \Illuminate\Http\RedirectResponse
    {
        $listing->delete();

        return redirect()->back()
            ->with('success', 'Listing deleted successfully.');
    }
}
