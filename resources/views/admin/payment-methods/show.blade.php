@extends('admin.layout.app')
@section('head')
    @php
        $title="طرق الدفع-تعديل"
    @endphp
@endsection
@section('content')
<ul class="breadcrumb pb30">
    <li><a href="#">الرئيسية</a></li>
    <li class="active">طرق الدفع</li>
    <li class="active">تعديل</li>
</ul>

@session('message')
<div class="alert alert-success alert-dismissible shadow" data-sr="wait 0s, then enter bottom and hustle 100%">
    <button type="button" class="close pull-left" data-dismiss="alert">×</button>
    <h4 class="text-lg"><i class="fa fa-check icn-xs"></i> تم بنجاح ...</h4>
    <p>{{$value}}</p>
</div>
@endsession

<div class="well bs-component" data-sr="wait 0s, then enter left and hustle 100%">

    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('payment-methods.update',$payment_method->id)}}">
        @csrf
        @method("PUT")

      <fieldset>

        <div class="form-group" data-sr="wait 0.6s, then enter bottom and hustle 100%">
          <label for="inputUser"  class="col-lg-2 control-label">أسم طريقة الدفع</label>
          <div class="col-lg-10 input-grup">
              <i class="fa fa-user"></i>
            <input type="text" name="name" value="{{$payment_method->name}}" class="form-control text-right" placeholder="اسم طريقة الدفع">
            @error('name')
            <span class="help-block text-danger">{{$message}}</span>
            @enderror
          </div>
        </div>

        <div class="form-group" data-sr="wait 0.3s, then enter bottom and hustle 100%">
            <label for="textArea" class="col-lg-2 control-label">محتوى نصى</label>
            <div class="col-lg-10">
              <textarea class="form-control" name="description" rows="5">{{$payment_method->description}}</textarea>
              @error('description')
              <span class="help-block text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>

        <div class="form-group" data-sr="wait 0.3s, then enter bottom and hustle 100%">
          <div class="col-xs-10 col-xs-pull-2">
            <button type="reset" class="btn btn-default">أبدء من جديد ؟</button>
            <button type="submit" class="btn btn-primary">حفظ</button>
          </div>
        </div>

      </fieldset>

    </form>

</div>
@endsection
