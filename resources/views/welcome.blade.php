@extends('layouts.app')
@section('css')
    #chatter_hero {
    background-image: url(./assets/images/hero_bg.jpg);
    width: 100%;
    min-height: 150px;
    position: relative;
    background-size: cover;
    background-position: center center;
    text-align: center;

    }
    .clear-1{
    height:30px;
    width:100%,
    }
    #forum  .btn.btn-primary {
    border: 2px solid #cee0e6;
    background: #fff;
    color: #0098cb;
    outline:none;
    }
    #forum .btn i {
    position: relative;
    top: 2px;
    }
    #forum  .menu_gauche > a {
    padding: 20px;
    display: block;
    }

    #forum  .cgauche .nav-pills > li > a .chatter-box {
    width: 10px;
    height: 10px;
    border-radius: 2px;
    float: left;
    position: absolute;
    top: 50%;
    margin-top: -5px;
    left: 10px;
    margin-left:-15px;
    }
    #forum  .cgauche .nav-pills > li  {
    padding-left:18px;
    font-size:15px;
    }
    #forum  .cgauche .nav-pills > li>a:hover{
    background:none;
    }
    .home-img{
    height:50px;
    margin-top:40px;
    }
    #forum .cgauche .btn {
    width: 100%;
    display:block;
    }
    #forum .btn {
    border: 0px;
    border-radius: 30px;
    }
    .cgauche{
    padding:0
    }

@endsection
@section('content')
    <div id="chatter_hero">
    <div id="chatter_hero_dimmer"></div> 
    <img src="{{asset('assets/images/logo-light.png')}}" class="home-img">
    </div>
    <div class="clear-1">
        
    </div>
    <div class="container" id="forum">
        <div class="row">
            <div class="col-md-2 cgauche">
                <div class="menu_gauche">
                    <button id="new_discussion_btn" class="btn btn-primary"><i class="fa  fa-comment"></i> New Discussion</button> 
                    <a href="/forums"><b><i class=" fa-comments-o fa "></i> All Discussions</a></b> <ul class="nav nav-pills nav-stacked"><li><a href="/forums/category/introductions"><div class="chatter-box" style="background-color: rgb(52, 152, 219);"></div> Introductions</a></li> <li><a href="/forums/category/general"><div class="chatter-box" style="background-color: rgb(46, 204, 113);"></div> General</a></li> <li><a href="/forums/category/feedback"><div class="chatter-box" style="background-color: rgb(155, 89, 182);"></div> Feedback</a></li> <li><a href="/forums/category/random"><div class="chatter-box" style="background-color: rgb(230, 126, 34);"></div> Random</a></li></ul></div>
            </div>
            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New sujet</div>
                    <div class="panel-body">
                        <a href="{{ url('/sujets') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/sujets', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('forum.sujets.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-body">
                    
                </div>
            </div>
        </div>
    </div>
@endsection
