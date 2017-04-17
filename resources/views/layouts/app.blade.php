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
                background: #f1f1f1;
                /*background: #eceff1;*/
                height: 100%;
                /*font-family:verdana,arial,sans-serif;*/
                color:#555555;
                font-family: 'open sans',sans-serif, 'Opens sans','Source sans Pro','Trebuchet Ms',serif;
            }
            .micone li i{
                font-size: 20px;
                line-height: 20px;
                float: left;
                padding-right: 5px;
            }
            .mtop5{margin-top: 5px;}
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
            .discussions .panel a:hover{color:#111111}
            .discussions .panel a{
                color: #243238;
                text-decoration:none;
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
            #username a:hover{background: #0061d5;color: #ffffff;}
            #username ul a{
                padding: 8px 10px;
            }
            #username>a{
                max-width: 150px;
                white-space: nowrap;
                text-overflow:ellipsis;
                overflow: hidden;
                padding: 5px 10px;
                margin: 10px auto;
                border-radius: 2px;
                color: inherit;
            }
            #username .dropdown-menu{
                margin-top: -10px;
                border-width: 0;
                padding-top: 0;
                padding-bottom: 0;
            }
            #search-group .form-control:focus{box-shadow:none;background: #fff; }
            #search-group .input-group-btn .btn,
            #search-group .form-control{
                border:1px solid #eee;
                background: #f5f5f5;
                outline: none;
                /*border-radius: 15px 0 0 15px;*/
            }
            #search-group .input-group-btn .btn{border-left-width: 0px}
            div.middle_title{
                padding: 0px;
                color: #1d2129;
                color: #1d1d1d;
                -webkit-transition: color 0.3s ease;
                transition: color 0.3s ease;
                font-size: 18px;
                /*font-weight: bold;*/
                padding-top: 10px;
                padding-bottom: 10px;
                display: block;
                font-family: Georgia, Lucida Grande, Tahoma, Verdana, Arial, sans-serif;
                font-size: 18px;
                font-weight: 500;
                line-height: 22px;
                padding: 0;
                margin-bottom: 5px;
                max-height: 110px;
                overflow: hidden;
                word-wrap: break-word;
                /*color: #4772d9;*/
                /*                font-family: Times,serif;*/
            }
            .bgfb{background: #FBFCFD}
            .bgf9{background: #f9fafb}
            .post-footer>div{border-top: 1px solid #ddd;}
            p.middle_content a{
                font-size: 12px;
                color:#333333 !important;
                font-family: Helvetica, Arial, sans-serif;
                line-height: 16px;                
            }
            p.middle_content{
                max-height: 90px;
                overflow: hidden;
            }
            .chatter_cat{
                /*                background: #ccc;
                                color: #fff;*/
                border-radius: 30px;
                font-weight: bold;
                font-size: 10px;
                padding: 3px 7px;
                display: inline;
                /*text-shadow:0 1px 0px #000;*/
                position: relative;
                top: -2px;
            }
            .pad15{padding: 15px}
            .pad0_15{padding:0 15px}
            .pad15_0{padding: 15px 0}
            .padtop10{padding-top: 0px}
            .pad-panel{padding: 0px  15px 5px}
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
                /*background: #31708f;*/
                padding: 10px;
                box-shadow: 0 1px 3px 0 rgba(44,62,80,0.15);
                /*background-color: #fff;*/
            }
            /*.navbar-default .navbar-brand,.navbar-default .navbar-nav>li>a,.navbar a{color: #fff;}*/

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
        </style>
        <style type="text/css">
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
                    <div class="navbar-header ">

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

                    <div class="collapse navbar-collapse " id="app-navbar-collapse">
                        <div class="" >


                            <!-- Right Side Of Navbar -->
                            @if (Auth::user())
                            <ul class="nav navbar-nav navbar-left micone">
                                <li data-toggle="tooltip" data-placement="bottom" title="Voir tous les sujets">
                                    <a href="{{route("showAllSujets")}}"><i class="fa  fa-retweet"></i> <span class="hidden_visible-lg">Tous les sujets</span></a>
                                </li>
                                <li data-toggle="tooltip" data-placement="bottom" title="Voir tous mes sujets">
                                    <a href="{{route("showLoginUserSujets")}}"><i class="fa fa-question-circle"></i> <span class="hidden_visible-lg ">Sujets</span></a>
                                </li>
                                <li data-toggle="tooltip" data-placement="bottom" title="Voir mes discussions ">
                                    <a href="{{route("showUserDiscussions")}}"><i class="fa fa-comment-o"></i> <span class="hidden_visible-lg">Discussions</span></a>
                                </li>
                                <li data-toggle="tooltip" data-placement="bottom" title="Voir mes sujets favoris">
                                    <a href="{{route("showFavorisSujets")}}"><i class="fa fa-star-o"></i> <span class="hidden_visible-lg">Favoris</span></a>
                                </li>
                            </ul>
                            @endif
                            <ul class="nav navbar-nav navbar-right " >
                                <!-- Authentication Links -->
                                <li>
                                    <form class="navbar-form" action="search" method="GET" role="search">
                                        <div class="input-group" id="search-group">
                                            <input type="text" name="query" class="form-control" placeholder="Rechercher un sujet ..." name="q">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                                @if (Auth::guest())
                                <li><a  href="{{ route('login') }}">Connexion</a></li>
                                <li><a href="{{ route('register') }}">Créer un compte</a></li>
                                @else


                                <li data-toggle="tooltip" data-placement="bottom" id="add_sujet" title="Ajouter un nouveau sujet">
                                    <!--<button type="button" class="btn btn-default" >Tooltip on left</button>-->
                                    <a href="{{route('NewSujet')}}" class="btn " ><i  class="fa fa-plus "></i><span class="hidden_visible-xs visible-xs"> Ajouter un sujet</span></a>
                                </li>
                                <li class="dropdown" id="username">
                                    <a href="#" class="dropdown-toggle"  data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} 
                                        <span class="fa fa-angle-down"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{route('showProfil')}}"><i class="fa fa-user-circle"></i> Profil</a>
                                        </li>
                                        <li>
                                            <a href="{{route('userNotifications')}}"><i class="fa  fa-bell-o"></i> Notifications</a>
                                        </li>
                                        <li>
                                            <a href="{{route('SettingProfil')}}"><i class="fa fa-cogs"></i> Paramètres</a>
                                        </li>
                                        <li>
                                            <a href="{{route('FaqForum')}}"><i class="fa fa-institution"></i> FAQ</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li class="">
                                            <a class="bold text-danger" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i>  Déconnexion
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>

                                    </ul>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class='container'>
                <div class='row'>
                    <div class='col-sm-12 col-sm-offset-0'>
                        @if(Session::has('flash_message'))
                        <p class="alert alert-info">{!! Session::get('flash_message') !!}</p>
                        @endif
                        @if(Session::has('info'))
                        <p class="alert alert-info">{!! Session::get('info') !!}</p>
                        @endif
                        @if(Session::has('danger'))
                        <p class="alert alert-danger">{!! Session::get('danger') !!}</p>
                        @endif
                        @if(Session::has('warning'))
                        <p class="alert alert-warning">{!! Session::get('warning') !!}</p>
                        @endif
                    </div>
                </div>
            </div>
            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/index.js') }}"></script>
        <!--<script type="text/javascript" src="{{asset('js/plugins/jquery.min.js')}}"></script>-->
        <!--<script type="text/javascript" src="{{asset('js/plugins/jquery.pjax.js')}}"></script>-->
        <script type="text/javascript">
                                                   /* $('a').attr('data-pjax',"#app");
                                                    $('a').pjax(undefined, {
                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                    alert("Could not use pjax!\n\n" + jqXHR + "\n\n" + textStatus + "\n\n" + errorThrown);
                                                    }
                                                    });
                                                    
                                                    $('body').bind('pjax:start', function(xhr, options) {
                                                    $("#app").css({"opacity":'.5'})
                                                    $(options.container).fadeOut("2000", function() {
                                                    alert("Faded out");
                                                    });
                                                    }).bind('pjax:end', function(xhr, options) {
                                                    $("#app").animate({"opacity":'.5'},10000)
                                                    $(options.container).hide("slow");
                                                    });*/
        </script>
    </body>
</html>
