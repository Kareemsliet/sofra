<div>
    <div class="login-form">
        <form action="{{route('client.login')}}" method="post">
            @csrf
            <div class="avatar">
                <img src="{{asset('web/imgs/use-img-1.png')}}" alt="">
            </div>
            <div class="fields">
                <div class="form-group">
                    <input type="email" wire:model.live='email' value="{{old('email')}}" class="form-control" id="exampleInputEmail1" placeholder="البريد الالكترونى" name="email" >
                    @error('email')
                        <p class="text text-danger fs-4 ">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password"  wire:model.live='password' value="{{old('password')}}" class="form-control"  placeholder="كلمة السر" name="password">
                    @error('password')
                        <p class="text text-danger fs-4 ">{{$message}}</p>
                    @enderror
                </div>

            <button @if($errors->any()) disabled @endif  type="submit" class="signin-btn">دخول</button>

                <div class="options">
                    <div class="row">
                        <div class="new-user col-md-6">
                            <a href="{{route('client.showRegisterForm')}}">مستخدم جديد؟</a>
                        </div>
                        <div class="forgot col-md-6">
                            <a href="{{route('client.password.forget')}}">نسيت كلمة السر؟</a>
                        </div>
                    </div>
                </div>
                <div class="creat-new">
                    <a href="{{route('client.showRegisterForm')}}">انشاء حساب جديد</a>
                </div>
            </div>
        </form>
    </div>
</div>
