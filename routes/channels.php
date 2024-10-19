<?php

use App\Broadcasting\ClientChannel;
use App\Broadcasting\RestaurantChannel;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Models.Client.{clientId}',ClientChannel::class,['guards'=>['client']]);

Broadcast::channel('App.Models.Restaurant.{restaurantId}',RestaurantChannel::class,['guards'=>['restaurant']]);
