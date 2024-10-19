<div>
    <div class="register-form">
        <form action="{{route('client.register')}}" enctype="multipart/form-data" method="POST">
            @csrf

            <div class="select-image" >
                <input type="file" wire:model.live='image' name="image" >
                <div class="overlay">
                    <div class="text text-center">
                        <i class="fas fa-camera"></i>
                        <p>اختر صورة</p>
                    </div>
                </div>
                <img src="{{asset('web/imgs/use-img-1.png')}}" alt="">
                @error('image')
                        <p class="text text-danger fs-4 ">{{$message}}</p>
                @enderror
            </div>

            <div class="fields">
                <div class="form-group">
                    <input type="text" wire:model.live='name' class="form-control"  id="exampleInputEmail1" placeholder="الاسم" name="name">
                    @error('name')
                        <p class="text text-danger fs-4 ">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="email" wire:model.live='email'   class="form-control" id="exampleInputEmail1" placeholder="البريد الالكترونى" name="email">
                    @error('email')
                    <p class="text text-danger fs-4 ">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" wire:model.live='phone' class="form-control"   placeholder="الجوال" name="phone">
                    @error('phone')
                        <p class="text text-danger fs-4 ">{{$message}}</p>
                    @enderror
                </div>

                <div class="">
                    <select wire:model.live='city_id' class="form-control border-0"  name="city_id"  placeholder="اختر مدينة" >
                        <option value="">اختر مدينة...</option>
                        @foreach ($cities as $value)
                         <option @if ($value->id==old('city_id'))
                            @selected(true)
                         @endif value="{{$value->id}}" >{{$value->name}}</option>
                        @endforeach
                    </select>
                    @error('city_id')
                        <p class="text text-danger fs-4 ">{{$message}}</p>
                    @enderror
                </div>

                <div  id="regions" class="mt-5">
                    <select  @unless($regions) disabled @endunless id="regions-box" wire:model.live='region_id'  class="form-control border-0" name="region_id"   placeholder="اختر حي" >
                        <option value="">اختر حي</option>
                        @if ($regions)
                        @foreach ($regions as $value)
                           <option @if ($value->id==old('region_id'))
                                 @selected(true)
                           @endif value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('region_id')
                        <p class="text text-danger fs-4 ">{{$message}}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control"  placeholder="تأكيد كلمة المرور" wire:model.live='password_confirmation' name="password_confirmation">
                    @error('password_confirmation')
                    <span class="help-block text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" wire:model.live='password' class="form-control"  placeholder="كلمة المرور" value="{{old('password')}}" name="password">
                    @error('password')
                    <span class="help-block text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="notice">
                    <small>بإنشاء حسابك انت توافق على <a href="#"> شروط الإستخدام </a>الخاصة بسفرة</small>
                </div>
                <button @if($errors->any()) disabled @endif type="submit" class="btn">دخول</button>
            </div>
        </form>
    </div>
</div>
