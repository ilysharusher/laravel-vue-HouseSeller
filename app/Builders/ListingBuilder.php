<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

class ListingBuilder extends Builder
{
    public function WithoutSold(): self
    {
        return $this->whereNull('sold_at');
    }

    public function ListingFilter(): self
    {
        return $this->when(request()->filled('priceFrom'), fn ($q) => $q->where('price', '>=', request('priceFrom')))
            ->when(request()->filled('priceTo'), fn ($q) => $q->where('price', '<=', request('priceTo')))
            ->when(request()->filled('beds'), fn ($q) => $q->where('beds', (int)request('beds') <= 5 ? '=' : '>=', request('beds')))
            ->when(request()->filled('baths'), fn ($q) => $q->where('baths', (int)request('baths') <= 5 ? '=' : '>=', request('baths')))
            ->when(request()->filled('areaFrom'), fn ($q) => $q->where('area', '>=', request('areaFrom')))
            ->when(request()->filled('areaTo'), fn ($q) => $q->where('area', '<=', request('areaTo')));
    }

    public function RealtorFilter(): self
    {
        return $this->when(
            request()->boolean('deleted') === true,
            fn ($query) => $query->withTrashed()
        )->when(
            request()->filled('by'),
            fn ($query) => in_array(request('by'), $this->sortable, true) ? $query->orderBy(
                request('by'),
                request('order', 'asc')
            ) : $query
        );
    }
}
