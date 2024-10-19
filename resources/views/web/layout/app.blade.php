@yield('head')
<!doctype html>
<html lang="en" dir="rtl">
@php
$setting=setting();
@endphp

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css"
        integrity="sha384-vus3nQHTD+5mpDiZ4rkEPlnkcyTP+49BhJ4wJeJunw06ZAp+wzzeBPUXr42fi8If" crossorigin="anonymous">

    <!--google fonts css-->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">

    <!--font awesome css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">

    <link rel="icon" href="{{asset('web/imgs/sofra logo.png')}}">

    <!--jquery ui css-->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!--icheck css-->
    <link href="{{asset('web/assets/plugins/icheck/skins/square/blue.css')}}" rel="stylesheet">

    <!--star rating css-->
    <link rel="stylesheet" type="text/css"
        href="{{asset('web/assets/plugins/star-rating-svg-master/src/css/star-rating-svg.css')}}">

    <link href="{{asset('admin/layout/checkBo.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/layout/layout.css')}}" rel="stylesheet" type="text/css"><!-- The Main Css -->
    <link href="{{asset('admin/layout/content.css')}}" rel="stylesheet" type="text/css">

    <!--owl carousel css-->
    <link rel="stylesheet" href="{{asset('web/assets/plugins/OwlCarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/assets/plugins/OwlCarousel/dist/assets/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{asset('web/assets/css/iziToast.min.css')}}">


    <!--style css-->
    <link rel="stylesheet" href="{{asset('web/assets/css/style.css')}}">

    @livewireStyles

    <title>{{"$title"}}-{{config('app.name')}}</title>

</head>

<body class="{{$classPage}}">

    @livewire('clint.header')

    <!--page-content-->
    @yield('content')

    <!--footer-->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="info col-md-6">
                    <div class="title">
                        <img src="{{asset('web/imgs/edit.png')}}" alt="">
                        <h3>من نحن</h3>
                    </div>
                    <div class="text">
                        <p>
                            {{$setting->description}}
                        </p>
                    </div>
                    <div class="social">
                        <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="#"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
                    </div>
                </div>
                <div class="logo col-md-6">
                    <img src="{{asset('storage/setting')}}/{{$setting->logo}}" alt="">
                </div>
            </div>
        </div>
    </div>

    @livewireScripts

    <script src="{{asset('web/assets/js/jquery-3.5.1.min.js')}}"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="{{asset('web/assets/js/popper.min.js')}}"></script>

    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"
        integrity="sha384-a9xOd0rz8w0J8zqj1qJic7GPFfyMfoiuDjC9rqXlVOcGO/dmRqzMn34gZYDTel8k" crossorigin="anonymous">
    </script>

    <script src="{{asset('web/assets/plugins/icheck/icheck.js')}}"></script>

    <!--star rate-->
    <script src="{{asset('web/assets/plugins/star-rating-svg-master/dist/jquery.star-rating-svg.js')}}"></script>

    <!--counter-->
    <script src="{{asset('web/assets/plugins/counter/jQuerySimpleCounter.js')}}"></script>

    <!--owl carousel-->
    <script src="{{asset('web/assets/plugins/OwlCarousel/dist/owl.carousel.min.js')}}"></script>

    <script src="{{asset('web/assets/js/main.js')}}"></script>

    <script src="{{asset('web/assets/js/iziToast.min.js')}}"></script>

    @vite(['resources/js/app.js'])

    <script>
        document.addEventListener('livewire:init', () => {
           Livewire.on('cart',() => {
               iziToast.success({
                 title:"اشعار!",
                 message:"تم اضافة عنصر للسلة بنجاح",
                 position:"bottomRight"
               })
           });
        });
        Livewire.on('order',(data) => {
               iziToast.success({
                 title:`${data.title}`,
                 message:`${data.des}`,
                 position:"bottomRight"
               })
           });
    </script>
</body>

</html>
