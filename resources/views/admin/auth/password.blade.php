@extends('admin.auth.layout.app')
@section('head')
    @php
        $title="تغيير كلمة السر";
    @endphp
@endsection
@section('content')
<div class="loginBox">
    <!-- LoginBox -->

    <h2>تغيير كلمة السر</h2>

    <form action="{{route('admin.password.reset')}}" method="POST" role="form">

        @csrf

        @method("Post")

        <div class="login-group">
            <i class="fa fa-user"></i>
            <input type="text" id="username" value="{{old('email')}}" name="email"  placeholder="البريد الاكتروني"><!-- UserName Input -->
            @error('email')
            <span class="help-block text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="login-group">
            <i class="fa fa-lock"></i>
            <input type="password" id="password" name="password" placeholder="كلمة المرور"><!-- Password Input -->
            @error('password')
            <span class="help-block text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="login-group">
            <i class="fa fa-lock"></i>
            <input type="password"  name="password_confirmation"  placeholder="اعادة كلمة السر"><!-- Password Input -->
            @error('password_confirmation')
            <span class="help-block text-danger">{{$message}}</span>
            @enderror
        </div>

        <div class="login-group">

            <div class="checkbox">

            </div>

            <button type="submit">دخول</button>

        </div><!-- Login-group end -->

    </form><!-- Form end -->

    <div class="line"></div><!-- Line Padding -->
    <!-- End of login-group of Soci Login system -->
    <div class="login-group text-xs">
        <h5 class="text-right text-flat mt20">هل لديك حساب؟</h5>
        لا تقلق يمكنك تسجيل الدخول
        <a href="{{route('admin.loginForm')}}">هذا النموذج</a>.
    </div><!-- End of login-group Password Forget System -->
</div>
@endsection
