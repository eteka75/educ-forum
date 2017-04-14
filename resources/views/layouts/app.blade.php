<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Forum') }}</title>

        <!-- Styles -->
        <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <!--<link href="{{ asset('css/style_gplus.css') }}" rel="stylesheet">-->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <!--<link href="{{ asset('assets/css/chatter.css') }}" rel="stylesheet">-->
          <script src="{{ asset('js/jquery.min.js') }}"></script>
        <style type="text/css">
            body{
                background: #F0F1F4;
                background: #eceff1;
            }
            html, body {
                height: 100%;
                /*font-family:verdana,arial,sans-serif;*/
                color:#555555;
            }
            .panel-default .panel-heading,.heading {
                background-color: #f9fafb;
                color: #555555;
            }
            .margin-top{
                margin-top: -20px;
            }
            .nav {
                font-family:Arial,sans-serif;
                font-size:13px;
            }

            .avatar_circle {
                width: 60px;
                height: 60px;
                line-height:55px;
                text-align: center;
                background: #263238;
                display: inline-block;
                border-radius: 30px;
                color: #fff;
                font-size: 20px;
            }
            div.middle_title{
                padding: 0px;
                color: #111;
                -webkit-transition: color 0.3s ease;
                transition: color 0.3s ease;
                font-size: 18px;
                /*font-weight: bold;*/
                padding-top: 10px;
                padding-bottom: 10px;
                display: block;

                /*color: #4772d9;*/
                /*                font-family: Times,serif;*/
            }
            .bgfb{background: #FBFCFD}
            p.middle_content a{
                font-size: 12px;
                color:#555 !important
            }
            .chatter_cat{
                background: #ccc;
                border-radius: 30px;
                font-weight: bold;
                font-size: 10px;
                padding: 3px 7px;
                display: inline;
                color: #fff;
                text-shadow:0 1px 0px #000;
                position: relative;
                top: -2px;
            }
            .pad15{padding: 15px}
            .pad0_15{padding:0 15px}
            .pad15_0{padding: 15px 0}
            .padtop10{padding-top: 0px}
            .pad-panel{padding: 0px  15px 15px}
            .navbar{
                margin-bottom: 0;

                background: #fff;
                /* background: linear-gradient(to left, #28a5f5, #1e87f0);
                 background: #286090;
                 background: #337ab7;*/
                /*background: linear-gradient(145deg, #4772d9, #6d47d9);*/
                background-color: #fff;
                /*background-color: #d6071b;*/
                padding-top: 15px;
                padding-bottom: 15px;
                border-bottom: 1px solid #eeeeee;
                border-bottom: 0px solid rgba(0,0,0,.0975);
                margin-bottom: 20px;
                background: #31708f;
                padding: 10px;
                box-shadow: 0 1px 3px 0 rgba(44,62,80,0.15);
                /*background-color: #fff;*/
            }
            .navbar-default .navbar-brand,.navbar-default .navbar-nav>li>a,.navbar a{color: #fff;}

            .categ-inline{
                margin-left: -2px;
            }
            .form-control{
                border-radius: 0;
                box-shadow: none;
                border-color: #dedede;            
                resize: none;
            }
            .pad0{padding: 0}
            .m0{margin: 0}
            @yield('css')
        </style>
        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                    'csrfToken' => csrf_token(),
            ]) !!}
            ;
        </script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header col-sm-1 bg-info">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse col-sm-4" id="app-navbar-collapse">


                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#">Mes sujets</a>
                            </li>
                            <li>
                                <a href="#">Mes discussions</a>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @else

                            <li>
                                <form class="navbar-form" role="search">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search" name="q">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                    <li>
                                        <a href="#">Profil</a>
                                    </li>
                                    <li>
                                        <a href="#">Paramètres</a>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
