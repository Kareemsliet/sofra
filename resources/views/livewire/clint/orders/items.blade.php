<div>
        <div class="navigation">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item col-6">
                    <a class="nav-link active" id="pills-current-tab" data-toggle="pill" href="#pills-current" role="tab" aria-controls="pills-current" aria-selected="false">طلبات حالية</a>
                </li>
                <li class="nav-item col-6">
                    <a class="nav-link" id="pills-previous-tab" data-toggle="pill" href="#pills-previous" role="tab" aria-controls="pills-previous" aria-selected="false">طلبات سابقة</a>
                </li>
            </ul>
            <div class="container">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-current" role="tabpanel" aria-labelledby="pills-current-tab">
                        <div class="current-orders">
                            @foreach ($currentOrder as $value)
                            <div class="current-card">
                                <div class="info row">
                                    <div class="image">
                                        <img src="{{asset('storage/restaurants/')}}/{{$value->restaurant->image}}" alt="">
                                    </div>
                                    <div class="details">
                                        <h2 class="main-color">{{$value->restaurant->name}}</h2>
                                        <ul>
                                            <li>رقم الطلب: <span>564416</span></li>
                                            <li>المجموع: <span>{{$value->total}} ريال</span></li>
                                        </ul>
                                    </div>
                                    <div class="options">
                                        <div class="d-flex gap-2 flex-column align-items-center">
                                            <button wire:click='deliveryOrder({{$value->id}})' class="receive">استلام</button>
                                            <div wire:loading wire:target='deliveryOrder' class="spinner-border text-primary" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2 flex-column align-items-center">
                                            <button wire:click='rejectOrder({{$value->id}})' class="refuse">رفض</button>
                                            <div wire:loading wire:target='rejectOrder' class="spinner-border text-primary" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
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
                                        <img src="{{asset('storage/restaurants/')}}/{{$value->restaurant->image}}" alt="">
                                    </div>
                                    <div class="details">
                                        <h2 class="main-color">{{$value->restaurant->name}}</h2>
                                        <ul>
                                            <ul>
                                                <li>التوصيل: <span>{{$value->delivery_cost}} ريال</span></li>
                                                <li>الاجمالى: <span>{{$value->total}}  ريال</span></li>
                                            </ul>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
