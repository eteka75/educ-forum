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
        <div class="col-md-9 ">
            <h3 class="page-title">Les catégories</h3>
            <div class="row">
                @foreach($categories as $category)

                <div class="col-sm-3 col-xs-6 pad5_10  ">
                    <div class="panel card-panel shadow1__ rond0 no-border ">
                        <?php
                        $image = ('uploads/users/img.jpg');
                        if (isset($category->image) && $category->image != '') {
                            $urlimg = ('uploads/' . config('forum.dossiers.category') . '/' . $category->image);
                            if (is_file($urlimg)) {
                                $image = $urlimg;
                            }
                        }
                        ?>
<!--                        <div class="img-div-cat">
                            <img  src="{{asset($image)}}" class="img-responsive" alt="Categorie" />
                        </div>-->
                        <div class="panel-body foot-div-cat">
                            <h5 class=" m5_0"><a class="no-link" href="{{route('categorie',$category->slug)}}">{{$category->name}}</a> <span class="text-primary pull-right"><i  class="fa fa-comments "></i> {{$category->discussions()->count()}}</span></h5>

                        </div>

                    </div>
                </div>

                @endforeach
                <div class="col-sm-12 text-center">
                    <div id="pagination">
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
<!--            <div class="panelpanel-body ">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search words with regular expressions ...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>-->
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
