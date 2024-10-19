<div>
    <section class="find-restaurants">
        <div class="container">
            <h2>ابحث عن مطعمك المفضل</h2>
            <div class="filter">
                <div class="row">
                    <div class="city col-md-6">
                        <div method="GET" action="#">
                            <div class="form-group">
                                <select class="form-control" wire:model.live='city_id'>
                                    <option value="">اختر المدينة</option>
                                    @foreach ($cities as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-arrow-down main-color"></i>
                            </div>
                        </div>
                    </div>
                    <div class="search col-md-6">
                        <div>
                            <input type="text" wire:model.live='search' placeholder="ابحث عن مطعمك المفضل">

                        </div>
                    </div>
                </div>
            </div>
            <div class="restaurants">
                <div class="row gap-2">
                    @foreach ($restaurants as $value)
                    @php
                    $rate=$value->ratings()->avg('rate')?$value->ratings()->avg('rate'):0;
                    $unrate=5-$rate;
                    $status=\App\Status\Restaruant::from($value->statue)->name();
                    if (\App\Status\Restaruant::CLOSE->value==$value->statue){
                    $status_color='red';
                    }else{
                    $status_color='green';
                    }
                    @endphp
                    <div class="col-md-6 mt-4">
                        <div class="the-card">
                            <a href="{{route('restaurant',$value->id)}}"></a>
                            <img src="{{asset('web/imgs/res-img.png')}}" alt="logo" class="logo">
                            <div class="info">
                                <h3 class="name secondary-color">{{$value->name}}</h3>
                                <div class="stars">
                                        @for ($i=1;$i<=$rate;$i++) <i class="fas fa-star main-color"></i>
                                        @endfor
                                        @for ($i=1;$i<=$unrate;$i++) <i class="fas fa-star"></i>
                                        @endfor
                                </div>
                                <div class="text">
                                    <p class="secondary-color">الحد الأدنى للطلب: {{$value->minimum_order}} ريال</p>
                                    <p class="secondary-color">رسوم التوصيل: {{$value->delivery_price}} ريال</p>
                                </div>
                            </div>
                            <div class="available">
                                <div class="{{" $status_color"}}-circle"></div>
                                <p class="secondary-color">{{"$status"}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex w-100 justify-content-center align-items-center">
                {{$restaurants->links()}}
            </div>
        </div>
    </section>
</div>
