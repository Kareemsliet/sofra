<div>
    <div class="page-content">

        <div class="container">
            @session('message')
            <div class="row">
                <div class="alert alert-success col-12">{{$value}}</div>
            </div>
            @endsession
            <h1 class="main-color text-center">اضافة عرض جديد</h1>
            <div class="product-form">
                <form class="text-center" method="POST" enctype="multipart/form-data"
                    action="{{route('offer.store')}}">
                    @csrf
                    @method('POST')
                    <div class="form-group choose-file">
                        <div class="photo">
                            @if ($image)
                            <img src="{{$image->temporaryUrl()}}" alt="">
                            @else
                            <img src="{{asset('web/imgs/default-image.jpg')}}" alt="">
                            @endif
                            <input wire:model.live='image' name="image" type="file">
                        </div>
                        @error('image')
                        <h6 class="text-right text-danger">{{$message}}</h6>
                        @enderror
                        @if ('image')
                        <div wire:loading wire:target='image' class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                         @else
                         <h3 class="secondary-color">صورة المنتج</h3>
                        @endif
                    </div>

                    <div class="form-group offer-name">
                        <input wire:model.live='name' name="name" type="text" class="form-control"
                            placeholder="اسم المنتج">
                        @error('name')
                        <span class="help-block text-right text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-group describtion">
                        <textarea wire:model.live='description' name="description" placeholder="وصف مختصر"></textarea>
                        @error('description')
                        <span class="help-block text-right text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group price">
                        <input type="text" wire:model.live='discount' name="discount" class="form-control"
                            placeholder="الخصم">
                        @error('discount')
                        <span class="help-block text-right text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group date">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="from">
                                    <i class="fas fa-calendar-alt secondary-color"></i>
                                    <input name="from"  wire:model.live='from' placeholder="من" type="date" >
                                    @error('from')
                                    <span class="help-block text-right text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="to">
                                    <i class="fas fa-calendar-alt secondary-color"></i>
                                    <input name="to" wire:model.live='to' placeholder="الى"type="date">
                                    @error('to')
                                    <span class="help-block text-right text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn">اضافة</button>
                </form>
            </div>
        </div>
    </div>


</div>
