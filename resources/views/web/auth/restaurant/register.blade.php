@extends('web.auth.layout.app')
@section('head')
 @php
     $classPage="register-seller-page";
     $title="انشاء حساب";
 @endphp
@endsection
@section('content')
<div class="page-content">
    <div class="container">
        @livewire('restaurant.register')
    </div>
</div>
@endsection
