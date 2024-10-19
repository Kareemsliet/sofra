<div>
    <div class="register-form">
        <form action="{{route('restaurant.register')}}" enctype="multipart/form-data" method="POST">
            @csrf

            <div class="select-image">
                <input type="file" wire:model.live='image' name="image">
                <div class="overlay">
                    <div class="text text-center">
                        <i class="fas fa-camera"></i>
                        <p>اختر صورة</p>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center flex-column gap-2">
                    @if ($image)
                    <img src="{{$image->temporaryUrl()}}" alt="">
                    @else
                    <img src="{{asset('web/imgs/use-img-1.png')}}" alt="">
                    @endif
                    <div wire:loading wire:target='image' class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                @error('image')
                <p class="text text-danger fs-4 ">{{$message}}</p>
                @enderror
            </div>

            <div class="fields">
                <div class="form-group">
                    <input type="text" wire:model.live='name' class="form-control" id="exampleInputEmail1"
                        placeholder="الاسم" name="name">
                    @error('name')
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="email" wire:model.live='email' class="form-control" id="exampleInputEmail1"
                        placeholder="البريد الالكترونى" name="email">
                    @error('email')
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" wire:model.live='phone' class="form-control" placeholder="الجوال" name="phone">
                    @error('phone')
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="mt-5 d-flex justify-content-center align-items-center gap-2">
                        @foreach ($categoryOptions as $value)
                        <div class="d-flex gap-2 m-2">
                            <label for="{{$value->name}}">{{$value->name}}</label>
                            <input @if (old('categories'))
                              @foreach (old('categories') as $category )
                                 @if ($category==$value->id)
                                    @checked(true)
                                 @endif
                              @endforeach
                            @endif type="checkbox"  name="categories[]"  id="{{$value->name}}" value="{{$value->id}}">
                        </div>
                        @endforeach
                </div>
                @error('categories')
                <span class="help-block text-right text-danger">{{$message}}</span>
                @enderror

                <div class="mt-5">
                    <select wire:model.live='city_id' class="form-control" name="city_id" placeholder="اختر مدينة">
                        <option value="">اختر مدينة...</option>
                        @foreach ($cities as $value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach
                    </select>
                    @error('city_id')
                    <p class="text text-danger fs-4 ">{{$message}}</p>
                    @enderror
                </div>

                <div id="regions" class="mt-5">
                    <select @unless($regions) disabled @endunless id="regions-box" wire:model.live='region_id'
                        class="form-control" name="region_id" placeholder="اختر حي">
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
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <input type="text" class="form-control" wire:model.live='minimum_order'
                        placeholder="احد الادني التوصيل" value="{{old('minimum_order')}}" name="minimum_order">
                    @error('minimum_order')
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" wire:model.live='delivery_price' class="form-control" placeholder="سعر التوصيل"
                        value="{{old('delivery_price')}}" name="delivery_price">
                    @error('delivery_price')
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" wire:model.live='phone_call' class="form-control"
                        placeholder="رقم الهاتف للتواصل" value="{{old('phone_call')}}" name="phone_call">
                    @error('phone_call')
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" wire:model.live='whatsapp_phone' class="form-control"
                        placeholder="رقم الواتساب للتواصل" name="whatsapp_phone">
                    @error('whatsapp_phone')
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" placeholder="تأكيد كلمة المرور"
                        wire:model.live='password_confirmation' name="password_confirmation">
                    @error('password_confirmation')
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" wire:model.live='password' class="form-control" placeholder="كلمة المرور"
                        value="{{old('password')}}" name="password">
                    @error('password')
                    <span class="help-block text-right text-danger">{{$message}}</span>
                    @enderror
                </div>


                <div class="notice">
                    <small>بإنشاء حسابك انت توافق على <span> شروط الإستخدام </span>الخاصة بسفرة</small>
                </div>
                <button @if($errors->any()) disabled @endif type="submit" class="btn">دخول</button>
            </div>
        </form>
    </div>
</div>
