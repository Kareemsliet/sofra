@extends('admin.auth.layout.app')
@section('head')
    @php
        $title="تسجيل دخول";
    @endphp
@endsection
@section('content')
<div class="loginBox">
    <!-- LoginBox -->
    <h2>تسجيل الدخول بحسابك</h2>

    <form action="{{route('admin.login')}}" method="POST" role="form">

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

            <div class="checkbox">
                <input type="checkbox" name="remember" value="{{"on"}}"  data-style="android" data-size="small" data-toggle="toggle"
                    data-onstyle="success" data-offstyle="danger" data-on="نعم تذكرنى" data-off="تذكرنى !"
                    data-width="100">
            </div>

            <button type="submit">دخول</button>

        </div><!-- Login-group end -->

    </form><!-- Form end -->

    <div class="line"></div><!-- Line Padding -->
    <!-- End of login-group of Soci Login system -->
    <div class="login-group text-xs">
        <h5 class="text-right text-flat mt20">هل نسيت كلمة المرور !</h5>
        لا تقلق يمكنك استرجاع كلمة المرور بواسطة
        <a href="{{route('admin.password.forget')}}">هذا النموذج</a>.
    </div><!-- End of login-group Password Forget System -->
</div>
@endsection
