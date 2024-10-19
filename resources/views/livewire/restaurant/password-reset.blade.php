<div>

    <div class="login-form">
        <form action="{{route('restaurant.password.update')}}" method="post">
            @csrf
            <input type="hidden" name="token" value="{{$token}}" >
            <div class="avatar">
                <img src="{{asset('web/imgs/use-img-1.png')}}" alt="">
            </div>
            <div class="fields">
                <div class="form-group">
                    <input type="email" wire:model.live='email' value="{{old('email')}}" class="form-control" id="exampleInputEmail1" placeholder="البريد الالكترونى" name="email" required="">
                    @error('email')
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" wire:model.live='password_confirmation'  placeholder="تأكيد كلمة المرور" name="password_confirmation">
                    @error('password_confirmation')
                    <span class="help-block text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password"  wire:model.live='password' class="form-control"  placeholder="كلمة السر" name="password" >
                    @error('password')
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                </div>


                <button type="submit" @if($errors->any()) disabled @endif class="signin-btn">ارسال</button>
                
            </div>
        </form>
    </div>
</div>
