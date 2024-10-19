@extends('admin.layout.app')
@section('head')
    @php
        $title="الدفوعات-تعديل"
    @endphp
@endsection
@section('content')
<ul class="breadcrumb pb30">
    <li><a href="#">الرئيسية</a></li>
    <li class="active">الدفوعات</li>
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

    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('payments.update',$payment->id)}}">
        @csrf
        @method("PUT")

      <fieldset>

        <div class="form-group" data-sr="wait 0.6s, then enter bottom and hustle 100%">
            <label for="inputUser"  class="col-lg-2 control-label">أسم المطعم</label>
            <div class="col-lg-10">
              <select class="form-control" name="restaurant_id" >
                @foreach ($restaurants as $value)
                <option @if ($payment->restaurant_id==$value->id)
                     @selected(true)
                @endif value="{{$value->id}}">{{$value->name}}</option>
                @endforeach
              </select>
              @error('restaurant_id')
              <span class="help-block text-danger">{{$message}}</span>
              @enderror
            </div>

        </div>

        <div class="form-group" data-sr="wait 0.6s, then enter bottom and hustle 100%">
            <label for="inputUser"  class="col-lg-2 control-label">الكمية</label>
            <div class="col-lg-10">
              <input type="text" value="{{$payment->total}}" name="total" class="form-control" >
              @error('total')
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
