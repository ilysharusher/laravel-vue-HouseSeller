<?php

use App\Broadcasting\StoreMessage;
use App\Broadcasting\StoreMessageStatus;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('store-message-event-{id}-chat', StoreMessage::class);
Broadcast::channel('store-message-status-event-{id}-user', StoreMessageStatus::class);
