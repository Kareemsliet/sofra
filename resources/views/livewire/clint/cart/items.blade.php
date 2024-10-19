<div>
    <div class="items d-flex  flex-column justify-content-center gap-3 align-items-center">
        @foreach ($restaurants as $restaurant)
        @php
            $client=auth('client')->user();
            $items=\App\Models\Cart::whereHas('product',function($query)use($restaurant,$client){
                $query->where('products.restaurant_id','=',$restaurant->id)->where('client_id','=',$client->id);
            })->get();
            $cost=0;
            foreach ($items as $key => $value) {
                if($value->offer_id){
                    $cost+=$value->offer_price*$value->quantity;
                }else{
                    $cost+=$value->price*$value->quantity;
                }
            }
            @endphp
          <div class="item-card  row flex-column w-75 ">
            <div class="row col-12 d-flex align-items-center justify-content-center">
               <div class="photo">
                 <img src="{{asset('storage/restaurants/')}}/{{$restaurant->image}}" width="60" height="60"  alt="">
               </div>
            </div>
            <div class="col-12">
             @foreach ($items as $value)
             <div wire:key='{{$value->id}}' class="item-card w-100">
                <div class="item-info row">
                    <div class="photo col-md-5">
                        <img src="{{asset('storage/restaurants/products/')}}/{{$value->product->image}}" alt="">
                    </div>
                    <div class="text col-md-7">
                        <p>{{$value->product->name}}</p>
                        <p class="main-color">
                            @if ($value->offer_id)
                                <del>{{$value->price}}</del> {{$value->offer_price}}
                                @else
                                {{$value->price}}
                            @endif
                            ريال
                        </p>
                        <p>البائع:{{$value->product->restaurant->name}}</p>

                        @livewire('clint.cart.input-quantity',['item'=>$value],key($value->id))

                    </div>
                </div>
                <button wire:click='deleteItem({{$value->id}})' class="remove-btn">
                    <i class="fas fa-times"></i>
                    مسح
                </button>
              </div>
             @endforeach
            </div>
            <div class="col-12 d-flex align-items-center justify-content-between mt-2">
             <a href="{{route('order.create',$restaurant->id)}}" class="btn btn-outline-danger">اضافة</a>
             <div class="">
                 الاحمالي:{{(float) $cost}} ريال
             </div>
          </div>
         </div>
        @endforeach
    </div>
    <div class="d-flex w-100 justify-content-center align-items-center">
        {{$restaurants->links()}}
    </div>
</div>
