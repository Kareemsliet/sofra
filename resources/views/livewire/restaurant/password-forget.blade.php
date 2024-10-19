<div>
    <div class="login-form">
        <form action="{{route('restaurant.password.email')}}" method="post">
            @csrf

            <div class="avatar">
                <img src="{{asset('web/imgs/use-img-1.png')}}" alt="">
            </div>

            <div class="fields">
                <div class="form-group">
                    <input type="email" wire:model.live='email' value="{{old('email')}}" class="form-control"  placeholder="البريد الالكترونى" name="email" required="">
                    @error('email')
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                    @session('status')
                    <p class="text text-success fs-4">{{$value}}</p>
                    @endsession
                </div>
                <button @if($errors->any()) disabled @endif type="submit" class="signin-btn">ارسال</button>

            </div>
        </form>
    </div>
</div>
