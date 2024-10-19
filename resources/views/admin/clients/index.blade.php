@extends('admin.layout.app')
@section('head')
@php
$title="العملاء";
@endphp
@endsection
@section('content')

<ul class="breadcrumb pb30">
    <li><a href="#">الرئيسية</a></li>
    <li class="active">العملاء</li>
</ul>

@session('message')
<div class="alert alert-success alert-dismissible shadow" data-sr="wait 0s, then enter bottom and hustle 100%">
    <button type="button" class="close pull-left" data-dismiss="alert">×</button>
    <h4 class="text-lg"><i class="fa fa-check icn-xs"></i> تم بنجاح ...</h4>
    <p>{{$value}}</p>
</div>
@endsession

<form action="{{url()->current()}}" class="form-horizontal" method="GET">
    <div class="form-group" data-sr="wait 0.6s, then enter bottom and hustle 100%">
        <div class="col-lg-12 input-grup">
            <i class="fa fa-search-plus"></i>
          <input type="text" name="q" value="{{isset($_GET['q'])?$_GET['q']:""}}" class="form-control text-right" placeholder="ابحث عن شى؟" />
        </div>
      </div>
</form>

<table id="no-more-tables" class="table table-bordered" role="table">
    <thead>
        <tr>
            <th width="20%" class="text-right">الاسم</th>
            <th width="20%" class="text-right">البريد الاكتروني</th>
            <th width="20%" class="text-right">الهاتف</th>
            <th width="20%" class="text-right">المدينة/الحي</th>
            <th width="30%" class="text-right">عدد الطلبات في السلة</th>
            <th width="10%" class="text-right">عدد الطلبات</th>
            <th width="30%" class="text-right">التحكم</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $value)
        <tr>
            <td data-title="الاسم">{{$value->name}}</td>
            <td data-title="اليريد الاكتروني">{{$value->email}}</td>
            <td data-title="التيلفون">{{$value->phone}}</td>
            <td data-title="الحي/الشارع">{{$value->region->city->name.'/'.$value->region->name}}</td>
            <td data-title="عدد السلة">{{count($value->cartItems)}}</td>
            <td data-title="الطلبات">{{count($value->orders)}}</td>
            <td data-title="التحكم" class="text-center">
                <a href="{{route('clients.destroy',$value->id)}}" onclick="event.preventDefault();document.getElementById('form{{$value->id}}').submit()" class="btn btn-danger btn-xs"><i class="fa fa-plus-square"></i> حذف</a>
                <form action="{{route('clients.destroy',$value->id)}}" id="form{{$value->id}}" method="post">
                    @csrf
                    @method("DELETE")
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="col-xs-12 mt30 text-center">
    {{$clients->onEachSide(4)->links()}}
</div>
@endsection
