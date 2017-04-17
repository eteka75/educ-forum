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
                <a href="{{ Config::get('forum.routes.home')}}"><b><i class=" fa-comments-o fa "></i> Toutes les catégories</a></b> 
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
            <div class="title-card">                
            <h4>Mes sujets</h4>
            </div>
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
