@extends('web.layout.app')

@section('head')
 @php
     $title="$product->name";
     $classPage="meal-page";
 @endphp
@endsection
@section('content')
<div class="page-content">
    <div class="meal-info">
        <div class="container">
            <div class="photo">
                <img style="width:100%" src="{{asset('storage/restaurants/products')}}/{{$product->image}}" alt="">
            </div>
            <div class="name text-center">
                <h1 class="secondary-color">{{$product->name}}</h1>
                <p  class="secondary-color">{{$product->description}}</p>
            </div>
            <div class="extra-info">
                <ul>
                    <li>
                        <i class="fas fa-piggy-bank fa-3x"></i>
                        <p class="secondary-color">
                            السعر:
                            <span>
                                @if ($product->offer_id)
                                <del>{{$product->price}}</del> {{$product->offer_price}}
                                @else
                                {{$product->price}}
                            @endif
                            ريال
                            </span>
                        </p>
                    </li>
                    <li>
                        <i class="far fa-clock fa-3x"></i>
                        <p class="secondary-color">مدة تجهيز الطلب: <span>{{$product->delivery_time}}</span></p>
                    </li>
                    <li>
                        <i class="fas fa-coins fa-3x"></i>
                        <p class="secondary-color">رسوم التوصيل: <span>{{$product->restaurant->delivery_price}} ريال</span></p>
                    </li>
                </ul>
            </div>
            @auth('client')
            @livewire('clint.cart-button',['product'=>$product])
            @endauth
        </div>
    </div>

     <div class="other-meals">
        <div class="subtitle">
            <div class="container">
                <h1 class="main-color">المزيد من اكلات هذا المطعم</h1>
            </div>
        </div>
        <div class="meals" style="background-image:url('{{asset('web/imgs/meals.jpg')}}')">
            <!-- Set up your HTML -->
            <div class="owl-carousel">
                @foreach ($products as $value)
                <div class="meal">
                    <a href="{{route('product',$value->id)}}">
                        <div class="info">
                            <h5>{{$value->name}}</h5>
                            <p>اضغط للتفاصيل</p>
                        </div>
                    </a>
                    <img src="{{asset('storage/restaurants/products/')}}/{{$value->image}}" alt="">
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
