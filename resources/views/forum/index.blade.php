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
    #forum .cgauche .btn {
    border: 0px;
    border-radius: 30px;
    }
    .cgauche{
    //padding:0
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
            <div class="col-md-3 cgauche">
                <div class="menu_gauche">
                    <button id="new_discussion_btn" class="btn btn-primary"><i class="fa  fa-comment"></i> New Discussion</button> 
                    <a href="{{ Config::get('forum.routes.home')}}"><b><i class=" fa-comments-o fa "></i> All Discussions</a></b> 
                    <ul class="nav nav-pills nav-stacked">
                        <?php if(isset($categories)){ ?>
                        @foreach($categories as $category)
                            <li><a href="{{ Config::get('forum.routes.home') }}/{{ Config::get('forum.routes.category') }}/{{ $category->slug }}"><div class="chatter-box" style="background-color:{{ $category->color }}"></div> {{ $category->name }}</a></li>
                        @endforeach
                        <?php }?>
                    </ul>
                    </div>
            </div>
            <div class="col-md-6">

                <div class="panel panel-default">
                    <div class="panel-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/sujets/new', 'class' => 'pad0 m0', 'files' => true]) !!}

                        @include ('forum.sujets.form')

                        {!! Form::close() !!}<br><br>

                    </div>
                </div>
                <div >
                    <ul class="discussions">
                        @foreach($discussions as $discussion)

                            <li class="panel">

                                <a class="discussion_list" href="/{{ Config::get('forum.routes.home') }}/{{ Config::get('forum.routes.discussion') }}/{{ $discussion->category->slug }}/{{ $discussion->slug }}">
                                    <div class="chatter_avatar">
                                        @if(Config::get('forum.user.avatar_image_database_field'))
                                            
                                            <?php $db_field = Config::get('forum.user.avatar_image_database_field'); ?>
                                            
                                            <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
                                            @if( (substr($discussion->user->{$db_field}, 0, 7) == 'http://') || (substr($discussion->user->{$db_field}, 0, 8) == 'https://') )
                                                <img src="{{ $discussion->user->{$db_field}  }}">
                                            @else
                                                <img src="{{ Config::get('forum.user.relative_url_to_image_assets') . $discussion->user->{$db_field}  }}">
                                            @endif
                                        
                                        @else
                                            
                                            <span class="chatter_avatar_circle" style="background-color:#<?php /* \DevDojo\Chatter\Helpers\ChatterHelper::stringToColorCode($discussion->user->email) */?>">
                                                {{ strtoupper(substr($discussion->user->email, 0, 1)) }}
                                            </span>
                                            
                                        @endif
                                    </div>

                                    <div class="chatter_middle">
                                        <h3 class="chatter_middle_title">{{ $discussion->title }} <div class="chatter_cat" style="background-color:{{ $discussion->category->color }}">{{ $discussion->category->name }}</div></h3>
                                        <span class="chatter_middle_details">Posted By: <span data-href="/user">{{ ucfirst($discussion->user->{Config::get('forum.user.database_field_with_user_name')}) }}</span> strtotime($discussion->created_at</span>
                                        <?php
                                            $body=collect($discussion->post)->toArray();
                                           echo"<br>";
                                           $discussion_body='';
                                           if(count($body)){
                                           $discussion_body=$body[0]["body"];
                                           };
                                           
                                        ?>                                

                                        <p>{{ substr(strip_tags($discussion_body), 0, 200) }}@if(strlen(strip_tags($discussion_body)) > 200){{ '...' }}@endif</p>
                                    </div>

                                    <div class="chatter_right">
                                        
                                    </div>

                                    <div class="chatter_clear"></div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div id="pagination">
                    {{ $discussions->links() }}
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-body ">
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search words with regular expressions ...">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
