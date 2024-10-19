@extends('admin.layout.app')
@section('head')
@php
$title="الدفوعات";
@endphp
@endsection
@section('content')

<ul class="breadcrumb pb30">
    <li><a href="#">الرئيسية</a></li>
    <li class="active">الدفوعات</li>
</ul>

@session('message')
<div class="alert alert-success alert-dismissible shadow" data-sr="wait 0s, then enter bottom and hustle 100%">
    <button type="button" class="close pull-left" data-dismiss="alert">×</button>
    <h4 class="text-lg"><i class="fa fa-check icn-xs"></i> تم بنجاح ...</h4>
    <p>{{$value}}</p>
</div>
@endsession

<table id="no-more-tables" class="table table-bordered" role="table">
    
    <thead>
        <tr>
            <th width="30%" class="text-right">اسم المطعم</th>
            <th width="30%" class="text-right">الكمية</th>
            <th width="30%" class="text-right">التحكم</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $value)
        <tr>
            <td data-title="المطعم">{{$value->restaurant->name}}</td>
            <td data-title="الاجمالي">{{$value->total}}</td>
            <td data-title="التحكم" class="text-center">
                <a href="{{route('payments.edit',$value->id)}}" class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> تعديل</a>
                <a href="{{route('payments.destroy',$value->id)}}" onclick="event.preventDefault();document.getElementById('form{{$value->id}}').submit()" class="btn btn-danger btn-xs"><i class="fa fa-plus-square"></i> حذف</a>
                <form action="{{route('payments.destroy',$value->id)}}" id="form{{$value->id}}" method="post">
                    @csrf
                    @method("DELETE")
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="col-xs-12 mt30 text-center">
    {{$payments->onEachSide(4)->links()}}
</div>
@endsection
