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
                            <span class="sr-only">Menu</span>
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
                        <p class="alert alert-default">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                            <strong>Parfait !</strong><br>
                            {!! Session::get('flash_message') !!} 
                        </p>
                        @endif
                        @if(Session::has('info'))
                        <p class="alert alert-info">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                            <strong>Information !</strong><br>
                            {!! Session::get('info') !!}
                        </p>
                        @endif
                        @if(Session::has('danger'))
                        <p class="alert alert-danger">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                            <strong>Désolé !</strong><br>
                            {!! Session::get('danger') !!}
                        </p>
                        @endif
                        @if(Session::has('warning'))
                        <p class="alert alert-warning">
                            <button type="button" data-dismiss="alert" aria-hidden="true" class="close">×</button>
                            <strong>Attention !</strong><br>
                            {!! Session::get('warning') !!}
                        </p>
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
        <script type="text/javascript" src="{{asset('js/plugins/jquery.pjax.js')}}"></script>
        <script type="text/javascript">
                                                   $('a').attr('data-pjax', "#app");
                                                   $('a').pjax(undefined, {
                                                       error: function (jqXHR, textStatus, errorThrown) {
                                                           alert("Could not use pjax!\n\n" + jqXHR + "\n\n" + textStatus + "\n\n" + errorThrown);
                                                       }
                                                   });

                                                   $('body').bind('pjax:start', function (xhr, options) {
                                                       $("#app").css({"opacity": '.5'})
                                                       $(options.container).fadeOut("2000", function () {
                                                           alert("Faded out");
                                                       });
                                                   }).bind('pjax:end', function (xhr, options) {
                                                       $("#app").animate({"opacity": '.5'}, 10000)
                                                       $(options.container).hide("slow");
                                                   });
        </script>
    </body>
</html>
