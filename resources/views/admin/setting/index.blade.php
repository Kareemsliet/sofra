@extends('admin.layout.app')
@section('head')
@php
$title="الاعدادات"
@endphp
@endsection

@section('content')
<ul class="breadcrumb pb30">
    <li><a href="#">الرئيسية</a></li>
    <li class="active">الاعدادات</li>
</ul>

@session('message')
<div class="alert alert-success alert-dismissible shadow" data-sr="wait 0s, then enter bottom and hustle 100%">
    <button type="button" class="close pull-left" data-dismiss="alert">×</button>
    <h4 class="text-lg"><i class="fa fa-check icn-xs"></i> تم بنجاح ...</h4>
    <p>{{$value}}</p>
</div>
@endsession


<div class="well bs-component" data-sr="wait 0s, then enter left and hustle 100%">

    <form class="form-horizontal" method="post" enctype="multipart/form-data"
        action="{{$setting?route('setting.update',$setting->id):route('setting.store')}}">
        @csrf

        <input type="hidden" name="_method" value="{{$setting?" PUT":"POST"}}">

        <fieldset>

            <div class="form-group" data-sr="wait 0.6s, then enter bottom and hustle 100%">
                <label for="inputUser" class="col-lg-2 control-label">أسم </label>
                <div class="col-lg-10 input-grup">
                    <i class="fa fa-user"></i>
                    <input type="text" name="name" value="{{$setting?$setting->name:old('name')}}"
                        class="form-control text-right" placeholder="اسم">
                    @error('name')
                    <span class="help-block text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group" data-sr="wait 0.6s, then enter bottom and hustle 100%">
                <label for="inputUser" class="col-lg-2 control-label">العمولة</label>
                <div class="col-lg-10 input-grup">
                    <input type="number" name="commission" value="{{$setting?$setting->commission*100:old('commission')}}"
                        class="form-control text-right" placeholder="العمولة">
                    @error('commission')
                    <span class="help-block text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group" data-sr="wait 0.3s, then enter bottom and hustle 100%">
                <label for="textArea" class="col-lg-2 control-label">محتوى نصى</label>
                <div class="col-lg-10">
                    <textarea class="form-control" name="description"
                        rows="5">{{$setting?$setting->description:old('description')}}</textarea>
                    @error('description')
                    <span class="help-block text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="post_img" class="col-xs-2 control-label">رفع لوجو</label>
                <div class="col-md-2 col-xs-12">

                    @if ($setting)

                    <div id="post_img" class="upload-img"><img width="60" height="60"
                            src="{{asset('storage/setting/')}}/{{$setting->logo}}" alt=""></div>
                    @else
                    <div id="post_img" class="upload-img"><span class="glyphicon glyphicon-picture"></span></div>
                    @endif

                    <input type="file" class="upload-img image-preview-input-1" id="post_img" name="logo"
                        placeholder="عنوان الموضوع هنا">
                    @error('logo')
                    <span class="help-block text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-xs-12">
                    <a class="image-preview" id="image-preview-1" data-toggle="lightbox" href="#demoLightbox"></a>
                </div>
            </div>

            <div class="form-group">
                <label for="post_img" class="col-xs-2 control-label">رفع صورة</label>
                <div class="col-md-2 col-xs-12">

                    @if ($setting)
                        @if ($setting->hero_image)
                        <div id="post_img" class="upload-img"><img width="60" height="60" src="{{asset('storage/setting/')}}/{{$setting->hero_image}}" alt=""></div>
                        @endif
                     @else
                     <div id="post_img" class="upload-img"><span class="glyphicon glyphicon-picture"></span></div>
                    @endif
                    <input type="file" class="upload-img image-preview-input-1" id="post_img" name="hero_image"
                        placeholder="عنوان الموضوع هنا">
                    @error('hero_image')
                    <span class="help-block text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-6 col-xs-12">
                    <a class="image-preview" id="image-preview-1" data-toggle="lightbox" href="#demoLightbox"></a>
                </div>
            </div>

            <div class="form-group" data-sr="wait 0.3s, then enter bottom and hustle 100%">
                <div class="col-xs-10 col-xs-pull-2">
                    @if ($setting)
                    <a onclick="event.preventDefault();document.getElementById('setting-form').submit()"  class="btn btn-default">هل تريد الحذف؟</a>
                    @else
                    <button type="reset" class="btn btn-primary">هل تريد البدء من حديد؟</button>
                    @endif
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </div>

        </fieldset>

    </form>

    @if ($setting)
    <form action="{{route('setting.destroy',$setting->id)}}" id="setting-form" method="post">
        @csrf
        @method('DELETE')
    </form>
    @endif
</div>
@endsection
