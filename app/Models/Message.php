<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'user_id',
        'text',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTimeAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    public function getIsOwnerAttribute(): bool
    {
        return (int) $this->user_id === (int) auth()->id();
    }
}
