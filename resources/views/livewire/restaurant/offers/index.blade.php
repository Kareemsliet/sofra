<div>

        <!--page-content-->
        <div class="page-content">
            <div class="container">
                <div class="subtitle">
                    <h1 class="main-color">العروض المتاحة الآن</h1>
                </div>
                <div class="add-btn">
                    <a href="{{route('offer.create')}}">اضف عرض جديد</a>
                </div>
                <div class="offers-list">
                    <div class="row">
                        @foreach ($offers as $value)
                        <div class="col-md-4">
                            <div class="offer-card">
                                <button wire:click='deleteOffer({{$value->id}})'><i class="fas fa-times-circle"></i></button>
                                <a href="{{route('offer.edit',$value->id)}}">
                                    <img src="{{asset('storage/restaurants/offers/')}}/{{$value->image}}" alt="">
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</div>
