<div>
    <div class="login-form">
        <form action="{{route('client.password.email')}}" method="post">
            @csrf

            <div class="avatar">
                <img src="{{asset('web/imgs/use-img-1.png')}}" alt="">
            </div>

            <div class="fields">
                <div class="form-group">
                    <input type="email" wire:model.live='email' value="{{old('email')}}" class="form-control"  placeholder="البريد الالكترونى" name="email" required="">
                    @error('email')
                        <p class="text text-danger fs-4 ">{{$message}}</p>
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