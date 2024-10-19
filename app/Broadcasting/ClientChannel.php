<?php

namespace App\Broadcasting;

use App\Models\Client;
use App\Models\User;

class ClientChannel
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
    public function join(Client $user,$clientId):array|bool
    {
        return $user->id==$clientId;
    }
}
