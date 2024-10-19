@extends('web.restaurant.layout.app')
@php
     $restaurant=auth('restaurant')->user();
@endphp
@section('head')
 @php
     $title="اضافة منتج-$restaurant->name";
     $classPage="add-new-product-page";
 @endphp
@endsection
@section('content')

@livewire('restaurant.products.add',['restaurant_id'=>$restaurant->id])

@endsection
