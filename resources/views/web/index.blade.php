@extends('web.layout.app')
@section('head')
@php
$title="الصفحة الرئيسية";
$classPage="";
$setting=setting();
@endphp
@endsection
@section('content')

<div class="intro" style="background-image:url('{{asset('storage/setting/')}}/{{$setting->hero_image}}')" >
    <h1>سفرة</h1>
    <p>بتشترى ..بتبيع؟ كله عند سفرة</p>
    @guest('client')
    <a href="{{route('client.login')}}">
        سجل الآن
        <img src="{{asset('web/imgs/dish.png')}}" alt="">
    </a>
    @endguest
</div>

@livewire('restaurants')

@endsection
