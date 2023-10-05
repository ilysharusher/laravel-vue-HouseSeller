<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListingImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'image',
    ];

    protected $appends = [
        'img_src',
    ];

    public function listing(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    public function getImgSrcAttribute(): string
    {
        return asset("storage/{$this->image}");
    }
}
