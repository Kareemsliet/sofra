<div>

    <div>
        <div class="page-content">

            <div class="container">
                @session('message')
                <div class="row">
                    <div class="alert alert-success col-12">{{$value}}</div>
                </div>
                @endsession
                <h1 class="main-color text-center">تعديل منتج جديد</h1>
                <div class="product-form">
                    <form class="text-center" method="POST" enctype="multipart/form-data"
                        action="{{route('product.update',$product->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="form-group choose-file">
                            <div class="photo">
                                @if ($image)
                                <img src="{{$image->temporaryUrl()}}" alt="">
                                @else
                                <img src="{{asset('storage/restaurants/products/')}}/{{$product->image}}" alt="">
                                @endif
                                <input wire:model.live='image' name="image" type="file">
                            </div>
                            @if ('image')
                            <div wire:loading wire:target='image' class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            @else
                            <h3 class="secondary-color">صورة المنتج</h3>
                            @endif
                        </div>

                        <div class="form-group product-name">
                            <input wire:model.live='name' name="name" type="text" class="form-control"
                                placeholder="اسم المنتج">
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="city col-md-12">
                                    <div>
                                        <div class="form-group">
                                            <select class="form-control" name="offer_id" wire:model.live='offer_id'>
                                                <option value="">اختر عرض</option>
                                                @foreach ($offers as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @error('offer_id')
                            <span class="help-block text-right text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div class="form-group describtion">
                            <textarea wire:model.live='description' name="description"
                                placeholder="وصف مختصر"></textarea>
                        </div>
                        <div class="form-group price">
                            <input type="text" wire:model.live='price' name="price" class="form-control"
                                placeholder="السعر">
                        </div>
                        <div class="form-group duration">
                            <input name="delivery_time" type="text" class="form-control" wire:model.live='delivery_time'
                                placeholder="مدة التجهيز">
                        </div>
                        <button type="submit" class="btn">تعديل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
