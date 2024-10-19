@extends('web.auth.layout.app')
@section('head')
 @php
     $classPage="login-page";
     $title="تحديث كلمة المرور";
 @endphp
@endsection
@section('content')
<div class="page-content">
    <div class="container">
       @livewire('restaurant.password-reset',['token'=>$token])
    </div>
</div>
@endsection
