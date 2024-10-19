<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RestaurantOrders implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     */
    public $restaurant;

    public $title;

    public $description;

   public function __construct($restaurant,$title,$description)
   {
      $this->restaurant=$restaurant;

      $this->title=$title;

      $this->description=$description;
   }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('App.Models.Restaurant.'.$this->restaurant->id),
        ];
    }

    public function broadcastWith(){
        return [
            'title'=>$this->title,
            'description'=>$this->description,
        ];
    }
}
