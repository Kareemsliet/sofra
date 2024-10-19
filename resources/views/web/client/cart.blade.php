@extends('web.layout.app')

@section('head')
 @php
     $title="carts";
     $classPage="cart-page";
 @endphp
@endsection
@section('content')
<div class="page-content">
    <div class="container">
        @livewire('clint.cart.items')
    </div>
</div>
@endsection
