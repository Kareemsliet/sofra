<?php

namespace App\Broadcasting;

use App\Models\Restaurant;
use App\Models\User;

class RestaurantChannel
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(Restaurant $user,$restaurantId): array|bool
    {
         return $user->id==$restaurantId;
    }
}
