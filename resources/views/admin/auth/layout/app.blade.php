@yield('head')

<!DOCTYPE html>
<html lang="ar">
<head>
	<meta charset="UTF-8">
	<title>{{$title}}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>

	<!--############################## Global Style Sheets ##############################-->
	<link href="{{asset('admin/layout/reset.css')}}" rel="stylesheet" type="text/css">
 	<link href="{{asset('admin/layout/strap.css')}}" rel="stylesheet" type="text/css">
 	<link href="{{asset('admin/layout/strap-toggle.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('admin/layout/layout.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('admin/layout/font-awesome.css')}}" rel="stylesheet" type="text/css">
	<!-- أضف
	<link href="{{asset('admin/layout/demo.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('admin/layout/demo.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('admin/layout/demo.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('admin/layout/demo.css')}}" rel="stylesheet" type="text/css"> -->

	<!--############################## Favicon Link ##############################-->
	<link rel="shortcut icon" href="favicon.ico"/>

</head>
<body>

	<div class="container"><!-- Container Start -->
		<div class="row"><!-- Row Start -->

			<div class="col-md-6 col-md-pull-3 col-sm-12 col-xs-12"><!-- The main responsive layout of Login Box -->

				<div class="loginBody"><!-- LoginBody Start -->

					<h2 class="text-center">لوحة التحكم</h2><!-- The Name of the main site -->

					@yield('content')

					<h4 class="text-center text-sm text-flat rtl">جميع الحقوق محفوظة لـ Admin Arabol.</h4><!-- CopyRight or a Small Note @ loginbox footer -->

				</div><!-- LoginMain end -->
			</div><!-- Main Responsive end -->


		</div><!-- Row end -->
	</div><!-- Container end -->


	<!-- Global javascript & jquery Files -->
	<!--############################## Jquery Libs ##############################-->
	<script src="{{asset('admin/js/jquery.min.js')}}" type="text/javascript"></script>
	<!--############################## BootStrap Libs ##############################-->
	<script src="{{asset('admin/js/strap.min.js')}}" type="text/javascript"></script>
	<!--############################## BootStrap CheckBoxs Libs ##############################-->
	<script src="{{asset('admin/js/strap-toggle.min.js')}}" type="text/javascript"></script>
	<!--############################## Scroll Animation ##############################-->
	<script src="{{asset('admin/js/scrollReveal.min.js')}}" type="text/javascript"></script>
	<!--############################## Custom jQuery Codes ##############################-->
	<script src="{{asset('admin/js/custom.min.js')}}" type="text/javascript"></script>

</body>
</html>
