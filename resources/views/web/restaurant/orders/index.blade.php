@extends('web.restaurant.layout.app')

@section('head')
 @php
     $title="الطلبات";
     $classPage="orders-page-restaurant";
 @endphp
@endsection
@section('content')
<div class="page-content">
        @livewire('restaurant.orders.items')
</div>
@endsection
