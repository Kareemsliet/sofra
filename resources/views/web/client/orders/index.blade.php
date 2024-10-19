@extends('web.layout.app')

@section('head')
 @php
     $title="الطلبات";
     $classPage="orders-page-client";
 @endphp
@endsection
@section('content')
<div class="page-content">
        @livewire('clint.orders.items')
</div>
@endsection
