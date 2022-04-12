{{-- @extends('layouts.adminlayout') --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Light Bootstrap Dashboard by Creative Tim</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{ asset('bower_components/light-dasboard-template/assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="{{ asset('bower_components/light-dasboard-template/assets/css/animate.min.css') }}" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{ asset('bower_components/light-dasboard-template/assets/css/light-bootstrap-dashboard.css?v=1.4.0') }}" rel="stylesheet"/>

    <!--  Custom CSS    -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="{{ asset('bower_components/light-dasboard-template/assets/css/pe-icon-7-stroke.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="wrapper">
        <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="" class="simple-text">
                       Admin
                    </a>
                </div>
                <ul class="nav">
                    <li class="menu active" id="home">
                        <a href="{{ route('home') }}">
                            <i class="pe-7s-graph"></i>
                            <p>{{ __('Dasboard') }}</p>
                        </a>
                    </li>
                    <li class="menu" id="user">
                        <a href="{{ route('users.index') }}">
                            <i class="pe-7s-user"></i>
                            <p>{{ __('User') }}</p>
                        </a>
                    </li>
                    <li class="menu" id="task">

                        <a href="{{ route('tasks.index') }}">
                            <i class="pe-7s-note2"></i>
                            <p>{{ __('Task') }}</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                    </div>
                    <div class="collapse navbar-collapse">
                        
                        <ul class="nav navbar-nav navbar-right">
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                                <ul class="dropdown-menu">
                                    <li> <a class="" href="{{ route('lang', ['en'])  }}">{{ __('EN') }}</a></li>
                                    <li><a class="" href="{{ route('lang', ['vi'])  }}">{{ __('VI') }}</a></li>
                                </ul>
                            @else
                                <li class="mt-3">
                                    <a href="{{ route('users.edit', Auth::user()->id) }}"><p>{{ Auth::user()->full_name }}</p></a>
                                </li>
                                <li class="dropdown mt-3">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <p>{{ __('Language') }} <b class="caret"></b></p>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li> <a class="" href="{{ route('lang', ['en'])  }}">{{ __('EN') }}</a></li>
                                        <li><a class="" href="{{ route('lang', ['vi'])  }}">{{ __('VI') }}</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                        <button type="submit" class="btn btn-logout">{{ __('Logout') }}</button>

                                    </form>
                                </li>
                                <li class="separator hidden-lg hidden-md"></li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    @if (Session::has('message'))
                    <div class="box box-default notify">
                        <input type="hidden" class="message" value="{{  Session::get('message')  }}">
                    </div>
                    @endif
                    @yield('content')
                </div>
            </div>
            <div class="modal fade" tabindexrole="dialog" id="delete-modal">  
                <div class="modal-dialog modal-sm" role="document">  
                    <div class="modal-content">  
                        <!-- modal-header -->  
                        <div class="modal-header" id="modal-head"></div>  
                        <!-- modal-body -->  
                        <div class="modal-body" id="modal-body"></div>  
                        <!-- modal-footer -->  
                        <div class="modal-footer" id="modal-footer"></div>  
                    </div>  
                </div>  
            </div>  
            <footer class="footer">
                <div class="container-fluid">
                </div>
            </footer>
        </div>
    </div>
</body>

    <!--   Core JS Files   -->
    <script src="{{ asset('bower_components/light-dasboard-template/assets/js/jquery.3.2.1.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('bower_components/light-dasboard-template/assets/js/bootstrap.min.js') }}" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="{{ asset('bower_components/light-dasboard-template/assets/js/chartist.min.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ asset('bower_components/light-dasboard-template/assets/js/bootstrap-notify.js') }}"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="{{ asset('bower_components/light-dasboard-template/assets/js/light-bootstrap-dashboard.js?v=1.4.0') }}"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="{{ asset('bower_components/light-dasboard-template/assets/js/demo.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</html>
