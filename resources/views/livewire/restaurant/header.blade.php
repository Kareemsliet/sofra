<div>
    <div class="nav-bar">
        <nav class="navbar navbar-collapse-lg navbar-light d-flex justify-content-around w-100 align-items-center">
            <div class="right-part col-md-4">
                <div class="icons">
                    @auth('restaurant')
                    <div class="user">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-circle main-color"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item secondary-color" href="{{route('restaurant.orders')}}">
                                    <i class="fas fa-clipboard-list"></i>
                                    <P>طلباتى</P>
                                </a>
                                <a class="dropdown-item secondary-color" href="{{route('offer.index')}}">
                                    <i class="fas fa-gift"></i>
                                    <P>العروض</P>
                                </a>
                                <a class="dropdown-item secondary-color" href="{{route('contact')}}">
                                    <i class="fas fa-envelope-square"></i>
                                    <P>تواصل معنا</P>
                                </a>
                                <a class="dropdown-item secondary-color"
                                    onclick="event.preventDefault();document.getElementById('restaurant-logout').submit()"
                                    href="{{route('restaurant.logout')}}">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <P>تسجيل الخروج</P>
                                </a>
                                <form action="{{route('restaurant.logout')}}" method="post" id="restaurant-logout">
                                    @csrf
                                    @method("POST")
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
            <a class="navbar-brand col-md-4 col-6" href="{{route('restaurant.index')}}">
                <img src="{{asset('storage/setting/')}}/{{$setting->logo}}">
            </a>
        </nav>
    </div>
</div>
