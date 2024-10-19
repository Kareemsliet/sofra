@extends('admin.layout.app')
@section('head')
@php
  $title="الصفحة الرئيسية"
@endphp
@endsection
@section('content')

<ul class="breadcrumb pb30">
    <li><a href="#">الرئيسية</a></li>
    <li class="active">الصفحة الرئيسية</li>
</ul>

<div class="mb50"></div>
<!-- Index Info's -->
@foreach ($sections as $value)
<div class="col-md-3 col-sm-3 col-xs-12" data-sr="wait 0s, then enter bottom"
    data-toggle="tooltip" data-placement="top" title="أضغط للمزيد">
    <a href="{{route($value['pages']['index']['route'])}}" class="btn-primary btn-block index-info">
        <span class="fa fa-{{$value['icon']}} icn-bk"></span>
        <span class="info-tit">عدد {{$value['name']}}</span>
        <span class="info-cont"><i class="fa fa-{{$value['icon']}}"></i><span class="badge">{{$value['count']}}
                {{$value['name']}}</span></span>
        <div class="clr"></div>
    </a>
</div>
@endforeach

<!--############################## Marging Bottom 50px ##############################-->
<div class="clearfix mb50"></div>
@endsection
