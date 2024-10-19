<div>
    <div class="nav-bar">
        <nav class="navbar navbar-collapse-lg navbar-light  d-flex justify-content-around w-100 align-items-center">
            <div class="right-part col-md-4">
                <div class="icons">
                    @auth('client')
                    <a href="{{route('carts')}}" class="cart d-flex justify-content-start align-items-center">
                        <span class="badge badge-warning">{{$countCartItems}}</span>
                        <i class="fas fa-shopping-cart"></i>
                    </a>

                    <div class="user">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-circle main-color"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a href="{{route('orders')}}" class="dropdown-item secondary-color" >
                                    <i class="fas fa-clipboard-list"></i>
                                    <P>طلباتى</P>
                                </a>
                                <a class="dropdown-item secondary-color" href="{{route('contact')}}">
                                    <i class="fas fa-envelope-square"></i>
                                    <P>تواصل معنا</P>
                                </a>
                                <a class="dropdown-item secondary-color"
                                    onclick="event.preventDefault();document.getElementById('client-logout').submit()"
                                    href="{{route('client.logout')}}">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <P>تسجيل الخروج</P>
                                </a>
                                <form action="{{route('client.logout')}}" method="post" id="client-logout">
                                    @csrf
                                    @method("POST")
                                </form>
                            </div>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>

            <a class="navbar-brand col-md-4 col-6" href="{{route('index')}}">
                <img src="{{asset('storage/setting/')}}/{{$setting->logo}}">
            </a>

        </nav>
    </div>
</div>
