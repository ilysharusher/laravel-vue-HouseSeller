<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'chat_id',
        'user_id',
        'text',
    ];

    public function messageStatus(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MessageStatus::class, 'id', 'message_id');
    }

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
        return (int)$this->user_id === (int)auth()->id();
    }

    public function getIsReadAttribute(): bool
    {
        return $this->messageStatus()->exists() && $this->messageStatus->is_read;
    }
}
