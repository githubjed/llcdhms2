<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LLCDHMS') }}</title>

    <link rel="shortcut icon" href="/images/llc_logo.png" />

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css" href="css/css-hamburgers/hamburgers.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
    <div>
        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="background-image:url('images/theme.jpg');background-size: cover;background-attachment: ;">
        <div class="container-fluid" >
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="{{ url('dashboard')}}" style="font-weight: bold;text-shadow: 2px 0 5px black;">Lapu-lapu City District Hospital Management System</a>
                 @guest
                 @else
                <!-- <ul class="nav navbar-top-links navbar-right" style="border-color: red;">

                    <li class="dropdown" style="padding-top:15px;background-color:transparent;color:white;text-transform: capitalize;font-weight: bold;text-shadow: 2px 0 5px black;">
                        Welcome {{ Auth::user()->name }} !
                    </li>
                    <li class="dropdown" style="background-color: transparent;"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <img src="uploads/{{ Auth::user()->avatar }}" width="30" style="border-radius: 50%">
                    </a>
                        <ul class="dropdown-menu dropdown-alerts" style="width: 50px;">
                            <li><a href="{{ url('/profile') }}">
                                <em class="fa fa-user"></em>View Profile
                                    
                            </a></li>
                            <li class="divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <em class="fa fa-power-off"></em> Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul> -->
                 @endguest
            </div>
        </div>
    </nav>

        @if (Route::has('login'))

                    @auth
                    <div class="container" style="margin-top: 100px;">

                        <div class="row justify-content-center" style="margin-top: 50px;">
                            <i>You are currently Login</i><br>
                             <b style="font-size: 30px;">Go to  <a href="{{ url('/dashboard') }}">Dashboard</a></b> 
                        </div>
                        <div class="col-sm-12" style="margin-top: 305px;">
                             <p class="back-link">Developed by <a href="#">Jendy Manatad</a></p>
                        </div>
                    </div>
                    @else
                         @yield('content')
                    @endauth
               
            @endif
        
    </div>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>
