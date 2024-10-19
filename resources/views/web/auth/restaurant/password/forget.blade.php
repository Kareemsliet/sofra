@extends('web.auth.layout.app')
@section('head')
 @php
     $classPage="login-page";
     $title="التحقق من البريد الاكتروني";
 @endphp
@endsection
@section('content')
<div class="page-content">
    <div class="container">
       @livewire('restaurant.password-forget')
    </div>
</div>
@endsection
