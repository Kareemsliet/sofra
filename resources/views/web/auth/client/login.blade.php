@extends('web.auth.layout.app')
@section('head')
 @php
     $classPage="login-page";
     $title="تسجيل دخول";
 @endphp
@endsection
@section('content')
<div class="page-content">
    <div class="container">
        @livewire('clint.login')
    </div>
</div>
@endsection
