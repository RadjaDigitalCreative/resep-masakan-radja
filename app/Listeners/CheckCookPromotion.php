<?php

namespace App\Listeners;

use Illuminate\Support\Facades\DB;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckCookPromotion
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the events.
     *
     * @param  RecipeLiked|RecipeCommented  $event
     * @return void
     */
    public function handle($event)
    {
        $user = auth()->user();

        if (! $user->isCook() && $user->verified) {
            $likes = DB::table('likeable_likes')->where('user_id', $user->id)->count();
            $comments = DB::table('comments')->where('user_id', $user->id)->count();

            if ($likes >= 10 && $comments >= 1) {
                $user->role_id = 2;
                $user->save();
                $user->sendPromotionNotification();
            }
        }
    }
}
