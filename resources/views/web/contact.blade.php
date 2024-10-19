@extends('web.layout.app')
@section('head')
 @php
     $title="تواصل معنا";
     $classPage="contact-us-page";
 @endphp
@endsection
@section('content')

@livewire('contact')

@endsection
