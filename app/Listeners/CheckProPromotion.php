<?php

namespace App\Listeners;

use App\Events\RecipeAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CheckProPromotion
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
     * Handle the event.
     *
     * @param  RecipeLiked|RecipeCommented  $event
     * @return void
     */
    public function handle(RecipeAdded $event)
    {
        $user = auth()->user();

        if (! $user->isPro() && $user->verified) {
            if ($user->recipes->count() >= 10) {
                $user->role_id = 3;
                $user->save();
                $user->sendPromotionNotification();
            }
        }
    }
}
