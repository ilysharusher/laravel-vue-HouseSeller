<?php

namespace App\Models;

use App\Builders\ListingBuilder;
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
        'sold_at'
    ];

    protected array $sortable = [
        'price',
        'created_at',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ListingImage::class);
    }

    public function offers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Offer::class);
    }

    public function messages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function newEloquentBuilder($query): ListingBuilder
    {
        return new ListingBuilder($query);
    }
}
