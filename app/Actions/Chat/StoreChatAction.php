<?php

namespace App\Actions\Chat;

use App\Http\Requests\Chat\StoreRequest;
use App\Models\Chat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoreChatAction
{
    private function getUserIdsAsString(array $user_ids): string
    {
        sort($user_ids);

        return implode('-', $user_ids);
    }

    public function __invoke(
        StoreRequest $request
    ): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder|\LaravelIdea\Helper\App\Models\_IH_Chat_QB|\Illuminate\Http\RedirectResponse|Chat {
        $user_ids = [(int)$request->validated()['user'], auth()->id()];

        try {
            DB::beginTransaction();

            $chat = Chat::query()->updateOrCreate([
                'users' => $this->getUserIdsAsString($user_ids),
                'listing_id' => (int)$request->validated()['listing_id'],
            ]);

            $chat->users()->sync($user_ids);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            Log::error($exception);

            return back()->with('error', $exception->getMessage());
        }

        return $chat;
    }
}
