@extends('web.restaurant.layout.app')
@php
     $restaurant=auth('restaurant')->user();
     $classPage="add-new-offer-page";
@endphp
@section('head')
 @php
     $title="اضافة عرض-$restaurant->name";
     $classPage="add-new-product-page";
 @endphp
@endsection
@section('content')

@livewire('restaurant.offers.add')

@endsection
