<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class AcceptOfferController extends Controller
{
    public function __invoke(Offer $offer): \Illuminate\Http\RedirectResponse
    {
        $listing = $offer->listing;
        $this->authorize('update', $listing);

        $offer->update([
            'accepted_at' => now()
        ]);

        $offer->listing()->update([
            'sold_at' => now()
        ]);

        $listing->offers()->except($offer)->update([
            'rejected_at' => now()
        ]);

        return redirect()->back()
            ->with('success', "Offer #{$offer->id} accepted, other one were rejected!");
    }
}