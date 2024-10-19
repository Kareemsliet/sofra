<div>
    <div class="page-content">
        <div class="container">
            @session('message')
            <div class="row">
                <div class="alert alert-warning col-12">{{$value}}</div>
            </div>
            @endsession
            <h1 class="main-color text-center">اضافة طلب</h1>
            <div class="product-form">
                <form class="text-center" method="POST" enctype="multipart/form-data"
                    action="{{route('order.add',$restaurant->id)}}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <div class="photo">
                            <img src="{{asset('storage/restaurants/')}}/{{$restaurant->image}}" alt="">
                        </div>
                    </div>

                    <div class="form-group describtion">
                        <textarea wire:model.live='description' name="description" placeholder="وصف مختصر"></textarea>
                        @error('description')
                        <span class="help-block text-right text-danger">{{$message}}</span>
                        @enderror
                    </div>
                  
                    <div class="issue-type row">
                        @foreach ($payment_methods as $value)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="{{$value->id}}"  name="payment_method_id"  @if (old('payment_method_id')==$value->id)
                                    @checked(true)                                    
                                @endif >
                                <label class="form-check-label" for="contact-type">{{$value->name}}</label>
                            </div>
                        </div>
                        @endforeach
                        @error('payment_method_id')
                        <span class="help-block text-right text-danger">{{$message}}</span>                            
                        @enderror
                    </div>
                    <div class="d-flex justify-content-lg-start justify-content-sm-center align-items-center">

                        <table  style="text-align:center">
                            <tbody>
                                @foreach ($items as $value)
                                <tr>
                                    <td>{{$value->product->name}}:</td>
                                    <td>{{$value->product->offer_id?$value->product->offer_price:$value->product->price}}ريال</td>
                                    <td></td>
                                    <td>{{$value->quantity}}x</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex mt-5 justify-content-lg-start justify-content-sm-center align-items-center">
                        <table>
                            <thead>
                                <tr>
                                    <th>التكلفة:</th>
                                    <th>{{$cost}}ريال</th>
                                </tr>
                                <tr>
                                    <th>سعر التوصيل:</th>
                                    <th>{{$restaurant->delivery_price}}ريال</th>
                                </tr>
                                <tr>
                                    <th>الاجمالي:</th>
                                    <th>{{$total}}ريال</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    

                    <button type="submit" class="btn mt-3">اضافة</button>
                </form>
            </div>
        </div>
    </div>


</div>
