@extends('web.restaurant.layout.app')
@php
     $restaurant=auth('restaurant')->user();
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
                <img src="{{asset('web/imgs/res-img.png')}}" alt="">
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
    @livewire('restaurant.products.index',['restaurant'=>$restaurant->id])
</div>
@endsection
