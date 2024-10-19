@extends('web.layout.app')
@php
     $classPage="add-new-offer-page";
@endphp
@section('head')
 @php
     $classPage="add-new-product-page";
     $title="اضافة طلب"
 @endphp
@endsection
@section('content')

@livewire('clint.orders.add',['restaurant'=>$restaurant])

@endsection
