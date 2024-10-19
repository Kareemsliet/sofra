@extends('admin.layout.app')
@section('head')
    @php
        $title="المدن-اضافة"
    @endphp
@endsection

@section('content')
<ul class="breadcrumb pb30">
    <li><a href="#">الرئيسية</a></li>
    <li class="active">المدن</li>
    <li class="active">اضافة</li>
</ul>

@session('message')
<div class="alert alert-success alert-dismissible shadow" data-sr="wait 0s, then enter bottom and hustle 100%">
    <button type="button" class="close pull-left" data-dismiss="alert">×</button>
    <h4 class="text-lg"><i class="fa fa-check icn-xs"></i> تم بنجاح ...</h4>
    <p>{{$value}}</p>
</div>
@endsession


<div class="well bs-component" data-sr="wait 0s, then enter left and hustle 100%">

    <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{route('cities.store')}}">
        @csrf
        @method("POST")

      <fieldset>

        <div class="form-group" data-sr="wait 0.6s, then enter bottom and hustle 100%">
          <label for="inputUser"  class="col-lg-2 control-label">أسم المدينة</label>
          <div class="col-lg-10 input-grup">
              <i class="fa fa-user"></i>
            <input type="text" name="name" value="{{old('name')}}" class="form-control text-right" placeholder="اسم المدينة">
            @error('name')
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
