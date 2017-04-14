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
height:00px;
width:100%,
}
/*#forum  .btn.btn-primary {
border: 2px solid #cee0e6;
background: #fff;
color: #0098cb;
outline:none;
}*/
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
.user_info{
font-size: 15px;
font-weight:bold;
-webkit-transition: color 0.3s ease;
transition: color 0.3s ease;
padding:0;
margin:0 0 5px;
border:0;
}
.user_post_date{color:#888888}
.list-card{
border:1px solid #d3e0e9;

max-width: 530px;
min-width: 280px;
width: 100%;
margin-left:auto;
margin-right:auto;
outline: none;
webkit-box-shadow: 0 1px 4px 0 rgba(0,0,0,0.14);
box-shadow: 0 1px 3px 0 rgba(0,0,0,0.014);
z-index: 1;
-webkit-border-radius: 2px;
border-radius: 12px;
display: block;
position: relative;
overflow: hidden;
text-align: start;
/***************************/
margin:  0px auto 20px auto;
/*padding: 15px 21px 15px 21px;*/
position: relative;
border: 1px solid #cfd8dc;
border:1px solid #e3e3e3;
color: #243238;
border-radius:5px;
border-radius: 4px;
-webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.05);
box-shadow: 0 1px 1px rgba(0,0,0,0.05);
}
.discussions .panel a:hover{color:#111111}
.discussions .panel a{
color: #243238;
text-decoration:none;
}
.middle_title{
margin:0;
padding:0;
}
/*.well, .panel {
border-color: #d2d2d2;
box-shadow: 0 1px 0 #cfcfcf;
border-radius: 3px;
}

.btn, .form-control, .panel, .list-group, .well {
<!--border-radius: 1px;-->
box-shadow: 0 0 0;
}*/
body {
//background-color: #eceff1;
-webkit-font-smoothing: antialiased;
}

@endsection
@section('content')
<!--    <div id="chatter_hero">
    <div id="chatter_hero_dimmer"></div> 
    <img src="{{asset('assets/images/logo-light.png')}}" class="home-img">
    </div>-->
<div class="clear-1">

</div>
<div class="container" id="forum">
    <div class="row">
        <div class="col-md-3 cgauche">

            <div class="menu_gauche">
                <button id="new_discussion_btn" class="btn btn-primary"><i class="fa  fa-comment"></i> New Discussion</button> 
                <a href="{{ Config::get('forum.routes.home')}}"><b><i class=" fa-comments-o fa "></i> All Discussions</a></b> 
                <ul class="nav nav-pills nav-stacked">
                    <?php if (isset($categories)) { ?>
                        @foreach($categories as $category)
                        <li><a href="/{{ Config::get('forum.routes.home') }}/{{ Config::get('forum.routes.category') }}/{{ $category->slug }}"><div class="chatter-box" style="background-color:{{ $category->color }}"></div> {{ $category->name }}</a></li>
                        @endforeach
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="col-md-6">

            <div class="list-card hidden  well" style="background: #FBFCFD"> 
                <form class="form-horizontal" role="form">
                    <h4>Quel est votre difficulté ?</h4>
                    <div class="form-group pad0_15"  >
                        <input class="form-control input-xs" placeholder="Ecrivez ici le problème encontré "/>
                    </div>
                    <div class="form-group pad0_15"  >
                        <select class="form-control">
                            <option>  &Equal; Sélectionnez le domaine de la question &Equal;</option>
                            <option> Géographie </option>
                            <option> Economie </option>
                        </select>
                    </div>
                    <div class="">
                        <div class="form-group pad0_15" >
                            <textarea class="form-control" placeholder="Décrivez ici le problème auquel vous êtes confronté "></textarea>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 col-md-9">
                                <ul class="list-inline"><li><a href="#"><i class="glyphicon glyphicon-picture"></i></a></li><li><a href="#"><i class="glyphicon glyphicon-align-center"></i></a></li><li><a href="#"><i class="glyphicon glyphicon-align-right"></i></a></li></ul>
                            </div>
                            <div class="col-xs-4 col-md-3">
                                <button type="submit" class="btn btn-primary center-block" >Soumettre </button>
                                <!--<button class="btn btn-primarys pull-right btn-xss" type="button">Diffuser</button>-->
                            </div>
                        </div>
                    </div>
                </form>
            </div>


            <div class="list-card  well bgfb">
                <h4>Quel est votre difficulté ?</h4>
                <div class=" ">
                    @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif

                    {!! Form::open(['url' => '/sujets/new', 'class' => 'pad0 m0', 'files' => true]) !!}

                    @include ('forum.sujets.form')

                    {!! Form::close() !!}

                </div>
            </div>
            <div >
                <div id="posts">
                    <ul class="discussions list-unstyled">
                        @foreach($discussions as $discussion)

                        <li class="panel post list-card" id="{{$discussion->id}}">

                            <div class="chatter_avatar panel-bodys">
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="pad15">

                                            @if(Config::get('forum.user.avatar_image_database_field'))

                                            <?php $db_field = Config::get('forum.user.avatar_image_database_field'); ?>

                                            <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
                                            @if( (substr($discussion->user->{$db_field}, 0, 7) == 'http://') || (substr($discussion->user->{$db_field}, 0, 8) == 'https://') )
                                            <img src="{{ $discussion->user->{$db_field}  }}">
                                            @else
                                            <img src="{{ Config::get('forum.user.relative_url_to_image_assets') . $discussion->user->{$db_field}  }}">
                                            @endif

                                            @else

                                            <span class="avatar_circle" style="height:50px;width:50px;  background:#<?php \App\Helpers\DataHelper::stringToColorCode($discussion->user->email) ?>">
                                                {{ strtoupper(substr($discussion->user->email, 0, 1)) }}
                                            </span>

                                            @endif
                                        </div>
                                    </div>
                                    <div  class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="pad15_0 ">

                                            <h5 class="user_info ">
                                                <a href="/user">{{ ucfirst($discussion->user->{Config::get('forum.user.database_field_with_user_name')}) }}</a>
                                            </h5>
                                            <p class="user_post_date"> 
                                                {{ \Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->diffForHumans() }}
                                            </p>
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <div class="chatter_middle pad-panel">
                                <a class="discussion_list" href="/{{ Config::get('forum.routes.home') }}/{{ Config::get('forum.routes.discussion') }}/{{ $discussion->category->slug }}/{{ $discussion->slug }}">
                                    <div class="middle_title">{{ $discussion->title }} <div class="chatter_cat" style="background-color:{{ $discussion->category->color }}">{{ $discussion->category->name }}</div></div>
                                </a>
                                <?php
                                $body = collect($discussion->post)->toArray();

                                $discussion_body = '';
                                if (count($body)) {
                                    $discussion_body = $body[0]["body"];
                                };
                                ?>                                

                                <p class="middle_content">  
                                    <a class="discussion_list" href="/{{ Config::get('forum.routes.home') }}/{{ Config::get('forum.routes.discussion') }}/{{ $discussion->category->slug }}/{{ $discussion->slug }}">
                                        {{ substr(strip_tags($discussion_body), 0, 200) }}@if(strlen(strip_tags($discussion_body)) > 200){{ '...' }}@endif
                                    </a>
                                </p>
                            </div>

                            <div class="chatter_right">

                            </div>

                            <div class="chatter_clear"></div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
            <div id="loading" class="text-center">
                Chargement ...
            </div>

            <div id="pagination">
                {{ $discussions->links() }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="panelpanel-body ">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search words with regular expressions ...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    ul li:last-child
</style>
<script>
    $(document).ready(function () {
        var win = $(window);
        var pageActuel = 1;
        win.scroll(function () {

            // End of the document reached?
            var h = $(document).height() - win.height();
            var top = win.scrollTop();
            if (h === top) {
                var last_id = $('ul').find('li.post:last-child').attr('id');

                $('#loading').show();
                $.ajax({
                    url: '/ajax/posts/',
                    dataType: 'html',
                    type: "GET",
                    data: 'page=' + pageActuel + '&last='+last_id,
                    success: function (json) {
                        $('#posts').append(json);
//                        alert("ok")
                        pageActuel++;
                        $('#loading').hide();
                    },
                    error: function (e, d) {
//                        alert(d.toString())
                    }
                });
            }
        });
    });
</script>
@endsection
