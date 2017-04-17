@extends('layouts.app')
@section('css')

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
                <button id="new_discussion_btn" class="btn btn-primary"><i class="fa  fa-comment"></i> Nouveau sujet</button> 
                <a href="{{ route('showAllCategory')}}"><b><i class=" fa-comments-o fa "></i> Toutes les catégories</a></b> 
                <ul class="nav nav-pills nav-stacked">
                    <?php if (isset($categories)) { ?>
                        @foreach($categories as $category)
                        <li class="<?=($category->slug==$slug)? "active":NULL;?>"><a href="/{{ Config::get('forum.routes.home') }}/{{ Config::get('forum.routes.category') }}/{{ $category->slug }}"><div class="chatter-box" style="background-color:{{ $category->color }}"></div> {{ $category->name }} <i class="fa fa-chevron-right mtop5 pull-right"></i></a></li>
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

            @if(!Auth::guest())
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
            @endif
            <div >
                <div id="posts">
                    <ul class="discussions list-unstyled">
                        {!! \App\Helpers\HtmlRender::HtmlConvertePost($discussions)!!}
                    </ul>
                </div>

            </div>
            <div id="loading" class="text-center hidden text-sm">
                Chargement ...
            </div>

            <div id="pagination" class="hidden" >
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

                if (!last_id)
                    return;
                $('#loading').show();
                $.ajax({
                    url: '/ajax/posts/',
                    dataType: 'html',
                    type: "GET",
                    data: 'page=' + pageActuel + '&last=' + last_id,
                    success: function (json) {
                        if (json === "") {
                            return false;
                        }
                        $('#posts>ul').append(json);
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
