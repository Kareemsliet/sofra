@extends('admin.layout.app')
@section('head')
@php
$title="الطلبات";
@endphp
@endsection
@section('content')

<ul class="breadcrumb pb30">
    <li><a href="#">الرئيسية</a></li>
    <li class="active">الطلبات</li>
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

<table id="no-more-tables" class="table table-bordered" style="text-align:center" role="table">
    <thead>
        <tr>
            <th width="10%" class="text-right">الاسم المطعم</th>
            <th width="10%" class="text-right">الاسم العميل</th>
            <th width="10%" class="text-right">الاجمالي</th>
            <th width="10%" class="text-right">المدينة/الحي</th>
            <th width="10%" class="text-right">طريقة الدفع</th>
            <th width="10%" class="text-right">العمولة</th>
            <th width="10%" class="text-right">التكلفة</th>
            <th width="10%" class="text-right">سغر التوصيل</th>
            <th width="10%" class="text-right">الوصف</th>
            <th width="10%" class="text-right">الحالة</th>
            <th width="20%" class="text-right">التحكم</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($orders as $value)
        <tr>
            <td data-title="اسم المطعم">{{$value->restaurant->name}}</td>
            <td data-title="اسم العميل">{{$value->client->name}}</td>
            <td data-title="الاجمالي">{{$value->total}}</td>
            <td data-title="الحي/الشارع">{{$value->client->region->city->name.'/'.$value->client->region->name}}</td>
            <td data-title="طريفة الدفع">{{$value->paymentMethod->name}}</td>
            <td data-title="العمولة">{{(float) $value->commission}}</td>
            <td data-title="التكلفة">{{$value->cost}}</td>
            <td data-title="سعر التوصيل">{{$value->delivery_cost}}</td>
            <td data-title="الوصف">{{$value->description?$value->description:"لا يوحد وصف"}}</td>
            <td data-title="الحالة">{{\App\Status\Order::from($value->state)->name()}}</td>
            <td data-title="التحكم" class="text-center">
                <a href="{{route('orders.destroy',$value->id)}}" onclick="event.preventDefault();document.getElementById('form{{$value->id}}').submit()" class="btn btn-danger btn-xs"><i class="fa fa-plus-square"></i> حذف</a>
                <form action="{{route('orders.destroy',$value->id)}}" id="form{{$value->id}}" method="post">
                    @csrf
                    @method("DELETE")
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="col-xs-12 mt30 text-center">
    {{$orders->onEachSide(4)->links()}}
</div>
@endsection
