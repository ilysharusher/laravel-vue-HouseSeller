<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'area',
        'beds',
        'baths',
        'city',
        'street',
        'street_number',
        'code',
        'price',
    ];

    protected $sortable = [
        'price',
        'created_at',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeListingFilter(Builder $query): Builder
    {
        return $query->when(
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
        );
    }

    public function scopeRealtorFilter(Builder $query)
    {
        return $query->when(
            request()->boolean('deleted') === true,
            fn($query) => $query->withTrashed()
        )->when(
            request()->filled('by'),
            fn($query) => in_array(request('by'), $this->sortable) ? $query->orderBy(
                request('by'),
                request('order', 'asc')
            ) : $query
        );
    }
}
