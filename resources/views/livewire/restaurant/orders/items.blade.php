<div>
    <div class="navigation">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item col-4">
                <a class="nav-link active" id="pills-new-tab" data-toggle="pill" href="#pills-new" role="tab" aria-controls="pills-new" aria-selected="true">طلبات جديدة</a>
            </li>
            <li class="nav-item col-4">
                <a class="nav-link" id="pills-current-tab" data-toggle="pill" href="#pills-current" role="tab" aria-controls="pills-current" aria-selected="false">طلبات حالية</a>
            </li>
            <li class="nav-item col-4">
                <a class="nav-link" id="pills-previous-tab" data-toggle="pill" href="#pills-previous" role="tab" aria-controls="pills-previous" aria-selected="false">طلبات سابقة</a>
            </li>
        </ul>
        <div class="container">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-new" role="tabpanel" aria-labelledby="pills-new-tab">
                    <div class="new-orders">
                        @foreach ($newOrders as $value)
                        <div class="new-card">
                            <div class="info row">
                                <div class="image">
                                    <img src="{{asset('web/imgs/person.png')}}" alt="">
                                </div>
                                <div class="details">
                                    <h3 class="secondary-color">العميل: <span>{{$value->client->name}}</span></h3>
                                    <ul>
                                        <li>المجموع: <span>{{$value->total}} ريال</span></li>
                                        <li>العنوان: <span>{{$value->client->region->city->name}}/{{$value->client->region->name}}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="options row">
                                <button class="call">اتصال</button>
                                <button wire:click='acceptOrder({{$value->id}})' class="receive">قبول</button>
                                <button wire:click='rejectOrder({{$value->id}})' class="refuse">رفض</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-current" role="tabpanel" aria-labelledby="pills-current-tab">
                    <div class="current-orders">
                        @foreach ($currentOrders as $value)
                        <div class="current-card">
                            <div class="info row">
                                <div class="image">
                                    <img src="{{asset('web/imgs/person.png')}}" alt="">
                                </div>
                                <div class="details">
                                    <h3 class="secondary-color">العميل: <span>{{$value->client->name}}</span></h3>
                                    <ul>
                                        <li>المجموع: <span>{{$value->total}} ريال</span></li>
                                        <li>العنوان: <span>{{$value->client->region->city->name}}/{{$value->client->region->name}}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="options row">
                                <button class="call">{{$value->client->phone}}</button>
                                <button wire:click='deliveryOrder({{$value->id}})' class="receive">استلام</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-previous" role="tabpanel" aria-labelledby="pills-previous-tab">
                    <div class="previous-orders">
                        @foreach ($oldOrders as $value)
                        <div class="previous-card">
                            <div class="info row">
                                <div class="image">
                                    <img src="{{asset('web/imgs/person.png')}}" alt="">
                                </div>
                                <div class="details">
                                    <h3 class="secondary-color">العميل: <span>{{$value->client->name}}</span></h3>
                                    <ul>
                                        <li>المجموع: <span>{{$value->total}} ريال</span></li>
                                        <li>العنوان: <span>{{$value->client->region->city->name}}/{{$value->client->region->name}}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="options row">
                                <button class="completed">الطلب {{\App\Status\Order::from($value->statue)->name()}}</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
