@extends('admin.layout.app')
@section('head')
@php
$title="المطاعم";
@endphp
@endsection
@section('content')

<ul class="breadcrumb pb30">
    <li><a href="#">الرئيسية</a></li>
    <li class="active">المطاعم</li>
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
            <th width="10%" class="text-right">الاسم</th>
            <th width="20%" class="text-right">البريد الاكتروني</th>
            <th width="20%" class="text-right">الهاتف</th>
            <th width="20%" class="text-right">المدينة/الحي</th>
            <th width="20%" class="text-right">الصورة</th>
            <th width="10%" class="text-right">التقييم</th>
            <th width="10%" class="text-right">حالة</th>
            <th width="10%" class="text-right">عدد المنتجات</th>
            <th width="10%" class="text-right">عدد العروض</th>
            <th width="20%" class="text-right">التحكم</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($restaurants as $value)
        <tr>
            <td data-title="اسم المطعم">{{$value->name}}</td>
            <td data-title="اسم اليميل">{{$value->email}}</td>
            <td data-title="الهاتف">{{$value->phone}}</td>
            <td data-title="الحي/الشارع">{{$value->region->city->name.'/'.$value->region->name}}</td>
            <td data-title="الصورة"><img src="{{asset('storage/restaurants/')}}/{{$value->image}}" alt=""></td>
            <td data-title="التقييم">{{(float) $value->ratings()->avg('rate')}}</td>
            <td data-title="الحالة">{{\App\Status\Restaruant::from($value->statue)->name()}}</td>
            <td data-title="عدد المنتجات">{{count($value->products)}}</td>
            <td data-title="عدد المطاعم">{{count($value->offers)}}</td>
            <td data-title="التحكم" class="text-center">
                <a href="{{route('restaurants.destroy',$value->id)}}" onclick="event.preventDefault();document.getElementById('form{{$value->id}}').submit()" class="btn btn-danger btn-xs"><i class="fa fa-plus-square"></i> حذف</a>
                <form action="{{route('restaurants.destroy',$value->id)}}" id="form{{$value->id}}" method="post">
                    @csrf
                    @method("DELETE")
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="col-xs-12 mt30 text-center">
    {{$restaurants->onEachSide(4)->links()}}
</div>
@endsection
