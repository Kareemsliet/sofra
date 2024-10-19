<?php

namespace App\Livewire\Clint\Orders;

use App;
use App\Events\RestaurantOrders;
use App\Models\Order;
use App\Notifications\OrderNotification;
use App\Status\Order as OrderStatus;
use Livewire\Component;

class Items extends Component
{
    public $client;

    function mount(){
        $this->client=auth('client')->user();
    }
    function deliveryOrder($id){
        $client=auth('client')->user();

        $order=Order::find($id);

        $order->update([
            'statue'=>OrderStatus::DELIVERIED->value,
        ]);

        $restaurant=$order->restaurant;

        event(new RestaurantOrders($restaurant,'حالة طلب',"تم تاكيد استلام الطلب من $client->name "));

        $restaurant->notify(new OrderNotification('حالة طلب',"تم تاكيد استلام الطلب من $client->name "));
    }

    function rejectOrder($id){
        $client=auth('client')->user();

        $order=Order::find($id);

        $order->update([
            'statue'=>OrderStatus::REJECT->value,
        ]);

        $restaurant=$order->restaurant;

        event(new RestaurantOrders($restaurant,'حالة طلب',"تم الغاء الطلب من $client->name "));

        $restaurant->notify(new OrderNotification('حالة طلب',"تم الغاء الطلب من $client->name "));
    }

    public function render()
    {
        $client=auth('client')->user();

        $currentOrder=$client->orders()->where('statue','=',OrderStatus::PENDING->value)->OrWhere('statue','=',OrderStatus::ACCEPT->value)->orderByDesc('created_at')->simplePaginate(8)->fragment('pills-current');

        $oldOrders=$client->orders()->where('statue','=',OrderStatus::REJECT->value)->orWhere('statue','=',OrderStatus::DELIVERIED->value)->orWhere('statue','=',OrderStatus::DECLINE->value)->orderByDesc('created_at')->simplePaginate(8)->fragment('pills-previous');

        return view('livewire.clint.orders.items',['currentOrder'=>$currentOrder,'oldOrders'=>$oldOrders]);
    }
}
