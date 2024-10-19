@yield('head')

<!DOCTYPE html>

<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>{{$title}}</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />

    <!-- Global Style Sheets -->
    <link href="{{asset('admin/layout/screen.css')}}" rel="stylesheet" type="text/css"><!-- Some Reset Css For Everything -->
    <link href="{{asset('admin/layout/strap.css')}}" rel="stylesheet" type="text/css"><!-- BootStrap Css Libs -->
    <link href="{{asset('admin/layout/strap-select.min.css')}}" rel="stylesheet" type="text/css"><!-- BootStrap Select Element -->
    <link href="{{asset('admin/layout/strap-toggle.min.css')}}" rel="stylesheet" type="text/css"><!-- BootStrap CheckBoxs Element -->
    <link href="{{asset('admin/layout/bootstrap-formhelpers.css')}}" rel="stylesheet" type="text/css">
    <!-- BootStrap Multi Purp. Element -->
    <link href="{{asset('admin/layout/checkBo.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/layout/layout.css')}}" rel="stylesheet" type="text/css"><!-- The Main Css -->
    <link href="{{asset('admin/layout/content.css')}}" rel="stylesheet" type="text/css"><!-- The Main Css For Content Page -->
    <link href="{{asset('admin/layout/font-awesome.css')}}" rel="stylesheet" type="text/css"><!-- Font Awesome Icons -->
    <link href="{{asset('admin/layout/morris.css')}}" rel="stylesheet" type="text/css"><!-- Chart Css Libs -->
    <link href="{{asset('admin/layout/media.css')}}" rel="stylesheet" type="text/css"><!-- The Main Css For Media Pages -->
    <!--############################## You Can Add More Stylesheet Links Bottom There ##############################-->
    <!-- أضف
	<link href="{{asset('admin/layout/reset.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('admin/layout/reset.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('admin/layout/reset.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('admin/layout/reset.css')}}" rel="stylesheet" type="text/css"> -->

    <!-- Favicon Link -->
    <link rel="shortcut icon" href="favicon.ico" />

    <!-- Jquery Lib -->
    <script src="{{asset('admin/js/jquery.min.js')}}" type="text/javascript"></script>

</head>
@php
   $sections=sections();
@endphp
<body>
    <!-- Top Head -->
    <header class="topHead">
        <div class="prl10">
            <div class="row">
                <div class="col-sm-4 col-xs-12">

                    <h1 class="logo">لوحة التحكم</h1><!-- The Main Name -->
                </div> <!-- col-xs-6 -->
                <div class="col-sm-8 col-xs-12 topNav">
                    <!-- Logout Button -->
                    <div class="btn-group user-infos">
                        <a  href="{{route('admin.logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit()" class="topA text-red" data-toggle="tooltip" data-placement="right"
                            title="تسجيل الخروج"><span class="fa fa-power-off fa-fw"></span></a>
                    </div>
                    <!-- User DropMenu -->
                    <div class="btn-group user-infos">
                        <a href="#" class="btn btn-sm btn-primary text-xs hidden-xs"><i class="fa fa-user fa-fw"></i>
                            اهلا,{{auth()->user()->name}} </a>
                        <a class="btn btn-sm btn-primary dropdown-toggle text-xs" data-toggle="dropdown"><span
                                class="fa fa-chevron-down fa-fw hidden-xs"></span><span
                                class="fa fa-user power-off fa-fw hidden-lg hidden-md hidden-sm"></span></a>
                        <ul class="dropdown-menu text-right global-drop">
                            <li role="presentation" class="dropdown-header text-right">وصول سريع</li>
                            <li><a href="{{route('admin.index')}}"><i class="fa fa-home"></i>الصفحة الرئيسية</a></li>
                            <li class="divider"></li>
                            <li role="presentation" class="dropdown-header text-right">تحكم سريع</li>
                            <li><a href="{{route('admin.password.forget')}}"><i class="fa fa-edit"></i>تعديل بياناتى</a></li>
                            <li class="divider"></li>
                            <li class="logout"><a href="{{route('admin.logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit()" ><i class="fa fa-power-off"></i>تسجيل الخروج</a></li>
                        </ul>
                    </div> <!-- btn-group -->

                    <!-- Responsive Menu Button -->
                    <div class="btn-group user-infos">
                        <a href="#" class="topA res-menu btn-primary hidden-md hidden-lg text-center"><span
                                class="fa fa-bars fa-fw"></span></a>
                    </div>

                    <form action="{{route('admin.logout')}}" id="logout-form" method="post">
                        @csrf
                        @method("POST")
                    </form>

                </div> <!-- col-xs-6 -->
            </div> <!-- Row -->
        </div> <!-- Container -->
    </header>

    <!-- MainBody -->
    <div class="box">
        <div class="row">
            <!-- main -->
            <div class="column col-md-10 col-sm-12" id="main">
                <div class="padding">
                    <div class="full col-md-9">
                        <!-- content -->
                        <!--############################## Title of the page & Time now also ##############################-->
                        <h2 class="text-flat">رئيسية التحكم <span class="text-sm">الصفحة الرئيسية</span></h2>


                        <!-- Margin bottom making some space for out show's :D -->

                        @yield('content')

                        <!--############################## jQuery Setting For Chart in tabpanel ##############################-->
                        <!--############################## jQuery Libs For Chart in tabpanel ##############################-->
                        <script src="{{asset('admin/js/chartjs.min.js')}}"></script>
                    </div><!-- /col-9 -->
                </div><!-- /padding -->
            </div>
            <!-- /main -->
            <!-- sidebar -->
            <div class="column col-md-2 col-xs-12" id="sidebar">

                <ul class="sideBar">
                    <li><a href="{{route('admin.index')}}"><i class="fa fa-home"></i><i
                                class="fa fa-chevron-left pull-left sideDown"></i>الصفحة الرئيسية</a></li>
                    <li><a href="{{route('setting.index')}}"><i class="fa fa-home"></i><i
                                    class="fa fa-chevron-left pull-left sideDown"></i> الاعدادات</a></li>

                   @foreach ($sections as $value )
                   <li class="menu"><i class="fa fa-{{$value['icon']}}"></i><i class="fa fa-chevron-down pull-left sideDown"></i>
                    {{$value['name']}}
                    <ul class="sideChild">
                        @if (auth()->user()->hasPermissionTo($value['pages']['index']['permission']))
                        <li><a href="{{route($value['pages']['index']['route'])}}"><i class="fa fa-table"></i>{{$value['name']}}</a></li>
                        @endif
                        @isset($value['pages']['add'])
                            @if (auth()->user()->hasPermissionTo($value['pages']['add']['permission']))
                            <li><a href="{{route($value['pages']['add']['route'])}}"><i class="fa fa-edit"></i>اضافة</a></li>
                            @endif
                        @endisset
                    </ul>
                  </li>
                   @endforeach
                </ul>
            </div>
            <!-- /sidebar -->
        </div><!-- Row End -->
    </div> <!-- mainBox End -->

    <!-- Global javascript & jquery Files -->
    <script src="{{asset('admin//ckeditor/ckeditor.js')}}"></script><!-- ckEditor -->
    <script src="{{asset('admin/js/strap.min.js')}}" type="text/javascript"></script><!-- BootStrap Libs -->
    <script src="{{asset('admin/js/strap-toggle.min.js')}}" type="text/javascript"></script><!-- BootStrap ChcekBoxs Element-->
    <script src="{{asset('admin/js/strap-select.min.js')}}" type="text/javascript"></script><!-- BootStrap Select Element -->
    <script src="{{asset('admin/js/scrollReveal.min.js')}}" type="text/javascript"></script><!-- Scroll Animation -->
    <script src="{{asset('admin/js/bootstrap-formhelpers.js')}}" type="text/javascript"></script><!-- BootStrap More Tools For Forms -->
    <script src="{{asset('admin/js/jquery.maskedinput.js')}}" type="text/javascript"></script><!-- BootStrap More Tools For Forms -->
    <script src="{{asset('admin/js/jquery.file-input.js')}}" type="text/javascript"></script><!-- BootStrap More Tools For Forms -->
    <script src="{{asset('admin/js/checkBo.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/js/custom.min.js')}}" type="text/javascript"></script><!-- Custom jQuery Stuff -->
</body>

</html>
