<div>
    <div class="meals-list">
        <div class="container">
            <h2 class="secondary-color">قائمة الطعام/منتجاتى</h2>
            <div class="add-product mt-3">
                <a href="{{route('product.create')}}">اضف منتج جديد</a>
            </div>
            <div class="meals mt-4">
                <div class="row d-flex">
                    @foreach ($products as $value)
                    <div class="col-md-4 mt-3">
                        <div class="card">
                            <a href=""></a>
                            <div class="image">
                                <button wire:click='deleteProduct({{$value->id}})'><i class="fas fa-times-circle"></i></button>
                                <a href="{{route('product.edit',$value->id)}}"></a>
                                <img src="{{asset('storage/restaurants/products/')}}/{{$value->image}}" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title main-color">{{$value->name}}</h3>
                                <p class="card-text">{{$value->description}}</p>
                                <div class="price">
                                    <img src="{{asset('web/imgs/piggy-bank.png')}}" alt="">
                                    <p class="main-color">
                                        @if ($value->offer_id)
                                            <del>{{$value->price}}</del> {{$value->offer_price}}
                                            @else
                                            {{$value->price}}
                                        @endif
                                        ريال
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="d-flex w-100 justify-content-center align-items-center">
            {{$products->links()}}
        </div>
    </div>
</div>
