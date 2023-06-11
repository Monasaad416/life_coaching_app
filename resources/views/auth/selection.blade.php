<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
		@include('layout.head')
	</head>


<body>
    <div class="wrapper">
        <section class="height-100vh d-flex align-items-center page-section-ptb login" style="background-image: url('{{ asset('assets/images/sativa.png')}}');">
            <div class="container">
                <div class="row justify-content-center no-gutters vertical-align">
                    <div style="border-radius: 15px;" class="col-lg-8 col-md-8 bg-white">
                        <div class="login-fancy pb-40 text-center">
                            <h3 style="font-family: 'Cairo', sans-serif" class="mb-30 my-4">{{trans('admin.select_user')}}</h3>
                            <div class="text-right">
                                <a class="btn btn-default" title="{{trans('admin.admins')}}" href="{{route('admin.login')}}">
                                   <img alt="user-img" width="100px;" src="{{URL::asset('assets/img/admin.png')}}">
                                   <h6 class="text-danger my-2">{{ trans('admin.admin') }}</h6>
                                </a>
                                <a class="btn btn-default col-lg-4" title="{{trans('admin.clients')}}" href="{{route('client.login')}}">
                                    <img alt="user-img" width="100px;" src="{{URL::asset('assets/img/client.png')}}">
                                    <h6 class="text-danger my-2">{{ trans('admin.client') }}</h6>
                                </a>
                                <a class="btn btn-default col-lg-4" title="{{trans('admin.coaches')}}" href="{{route('coach.login')}}">
                                    <img alt="user-img" width="100px;" src="{{URL::asset('assets/img/coach.png')}}">
                                    <h6 class="text-danger my-2">{{ trans('admin.coach') }}</h6>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--=================================
 login-->

    </div>
    <!-- jquery -->
    <script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
    <!-- plugins-jquery -->
    <script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
    <!-- plugin_path -->
    <script>
        var plugin_path = 'js/';
    </script>


    <!-- toastr -->
    @yield('js')
    <!-- custom -->
    <script src="{{ URL::asset('assets/js/custom.js') }}"></script>


</html>
