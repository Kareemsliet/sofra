@extends('web.layout.app')
@php
     $setting=setting();
     $rate=$restaurant->ratings()->avg('rate');
     $unrate=5-$rate;
@endphp
@section('head')
 @php
     $title="الصفحة المنتجات-$restaurant->name";
     $classPage="restaurant-client-page";
 @endphp
@endsection
@section('content')
<div class="page-content text-center">

    <div class="restaurant-banner" style="background-image: url('{{asset('web/imgs/rest-bg.jpg')}}')">
        <div class="container" >
            <div class="image">
                <img src="{{asset('storage/restaurants/')}}/{{$restaurant->image}}" alt="">
            </div>
            <div class="rate">
                <div class="stars">
                    @for ($i=1;$i<=$rate;$i++)
                    <i class="fas fa-star main-color"></i>
                    @endfor
                    @for ($i=1;$i<=$unrate;$i++)
                    <i class="fas fa-star secondary-color"></i>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <div class="meals-list">
        <div class="container">
            <div class="meals mt-4">
                <div class="row d-flex">
                    @foreach ($products as $value)


                    <div class="col-md-4 mt-3">
                        <div class="card">
                            <div class="image">
                                <a href="{{route('product',$value->id)}}"></a>
                                <img src="{{asset('storage/restaurants/products/')}}/{{$value->image}}" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title main-color">{{$value->name}}</h3>
                                <p class="card-text">{{$value->decription}}</p>
                                <div class="time">
                                    <img src="imgs/tray2.png" alt="">
                                    <p class="main-color">{{$value->delivery_time}} دقيقة تقريبا</p>
                                </div>
                                <div class="price">
                                    <img src="{{asset('web/imgs/piggy-bank.png')}}" alt="">
                                    <p class="main-color">
                                        @if ($value->offer_id)
                                            <del>{{$value->price}}</del> {{$value->offer_price}}
                                            @else
                                            {{$value->price}}
                                        @endif
                                        ريال
                                    </p>
                                </div>
                                <div class="d-flex justify-content-center align-items-center gap-3">
                                    <div class="details">
                                        <a href="{{route('product',$value->id)}}">اضغط للتفاصيل</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="d-flex w-100 justify-content-center align-items-center">
            {{$products->links()}}
        </div>
    </div>
</div>
@endsection
