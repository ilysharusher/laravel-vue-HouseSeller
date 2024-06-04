<?php

namespace App\Http\Controllers\Chat\Message;

use App\Actions\Chat\StoreMessageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\MessageResource;

class MessageController extends Controller
{
    public function store(StoreRequest $request, StoreMessageAction $action): \Illuminate\Http\JsonResponse|array
    {
        $message = $action($request);

        return MessageResource::make($message)->resolve();
    }
}
