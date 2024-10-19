@extends('web.auth.layout.app')
@section('head')
 @php
     $classPage="register-client-page";
     $title="انشاء حساب";
 @endphp
@endsection
@section('content')
<div class="page-content">
    <div class="container">
        @livewire('clint.register')
    </div>
</div>
@endsection

