<?php

namespace App\Livewire\Restaurant\Orders;

use App\Events\ClientOrders;
use Livewire\Component;
use App\Models\Order;
use App\Notifications\OrderNotification;
use App\Status\Order as OrderStatus;

class Items extends Component
{
    public $restaurant;

    function mount(){
        $this->restaurant=auth('restaurant')->user();
    }

    function deliveryOrder($id){

        $restaurant=auth('restaurant')->user();

        $order=Order::find($id);

        $order->update([
            'statue'=>OrderStatus::DELIVERIED->value,
        ]);

        $client=$order->client;

        event(new ClientOrders($client,'حالة طلب'," تم تاكيد استلام الطلب من مطعم $restaurant->name"));

        $client->notify(new OrderNotification('حالة طلب'," تم تاكيد استلام الطلب من مطعم $restaurant->name"));
    }

    function rejectOrder($id){
        $restaurant=auth('restaurant')->user();

        $order=Order::find($id);

        $order->update([
            'statue'=>OrderStatus::REJECT->value,
        ]);

        $client=$order->client;

        event(new ClientOrders($client,'حالة طلب'," تم تاكيد رفض الطلب من مطعم $restaurant->name"));

        $client->notify(new OrderNotification('حالة طلب'," تم تاكيد رفض الطلب من مطعم $restaurant->name"));
    }

    function acceptOrder($id){
        $restaurant=auth('restaurant')->user();

        $order=Order::find($id);

        $order->update([
            'statue'=>OrderStatus::ACCEPT->value,
        ]);

        $client=$order->client;

        event(new ClientOrders($client,'حالة طلب'," تم تاكيد قبول الطلب من مطعم $restaurant->name"));

        $client->notify(new OrderNotification('حالة طلب'," تم تاكيد قبول الطلب من مطعم $restaurant->name"));
    }

    public function render()
    {
        $client=auth('client')->user();

        $newOrders=$client->orders()->where('statue','=',OrderStatus::PENDING->value)->orderByDesc('created_at')->simplePaginate(8)->fragment('pills-new');

        $currentOrders=$client->orders()->where('statue','=',OrderStatus::ACCEPT->value)->orderByDesc('created_at')->simplePaginate(8)->fragment('pills-current');

        $oldOrders=$client->orders()->where('statue','=',OrderStatus::REJECT->value)->orWhere('statue','=',OrderStatus::DELIVERIED->value)->orWhere('statue','=',OrderStatus::DECLINE->value)->orderByDesc('created_at')->simplePaginate(8)->fragment('pills-previous');

        return view('livewire.restaurant.orders.items',['currentOrders'=>$currentOrders,'newOrders'=>$newOrders,'oldOrders'=>$oldOrders]);
    }
}
