@extends('web.restaurant.layout.app')
@php
$restaurant=auth('restaurant')->user();
@endphp
@section('head')
 @php
     $title="تعديل منتج-$restaurant->name";
     $classPage="add-new-product-page";
 @endphp
@endsection
@section('content')

@livewire('restaurant.products.edit',['restaurant_id'=>$restaurant->id,'product'=>$product])

@endsection
