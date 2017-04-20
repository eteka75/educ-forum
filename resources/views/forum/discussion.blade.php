@extends('layouts.app')
@section('content')
<style>

</style>

<div class="body">
    <div class="container">
        <div class="row">


            <div class="col-md-9">
                <h3 class="page-title">
                    {{$discussion->title}}

                    <span class="chatter_head_details pull-right"> {{ Config::get('chatter.titles.category') }}<a class="chatter_cat" href="/{{ Config::get('forum.routes.home') }}/{{ Config::get('forum.routes.category') }}/{{ $discussion->category->slug }}" style="background-color:{{ $discussion->category->color }}">{{ $discussion->category->name }}</a></span>
                    <br>
                    <?php
                    setlocale(LC_TIME, 'French');
                    ?>
                    <small class="text-sm">Par : <span class="text-muted bold"> {{$discussion->user()->first()->name}},</span> le {{ \Carbon\Carbon::createFromTimeStamp(strtotime($discussion->created_at))->formatLocalized('%A %d %B %Y')}}</small>
                </h3>
            </div>
            <div class="col-md-9">
                <div class="td-default-sharing ">
                    <ul class="list-inline ">
                        <li>
                            <a class="td-social-sharing-buttons td-social-facebook" href="https://www.facebook.com/sharer.php?u={{URL::to('/').'/'.Request::path()}}" onclick="window.open(this.href, 'mywin', 'left=50,top=50,width=600,height=350,toolbar=0'); return false;">
                                <i class="fa fa-facebook"></i>
                                <div class="td-social-but-text hidden-sm hidden-xs">Partager sur Facebook</div>
                            </a> 
                        </li>
                        <li>
                            <a class="td-social-sharing-buttons td-social-twitter" href="https://twitter.com/intent/tweet?text={{$discussion->title}}&amp;url={{URL::to('/').'/'.Request::path()}}&amp;via=FORUM+ETUDIANT+WEB" onclick="window.open(this.href, 'mywin', 'left=50,top=50,width=600,height=400,toolbar=0'); return false;">
                                <i class="fa fa-twitter"></i>
                                <div class="td-social-but-text hidden-sm hidden-xs">Poster sur Twitter</div>
                            </a> 
                        </li>
                        <li>
                            <a class="td-social-sharing-buttons td-social-google" href="https://plus.google.com/share?url={{URL::to('/').'/'.Request::path()}}" onclick="window.open(this.href, 'mywin', 'left=50,top=50,width=600,height=350,toolbar=0'); return false;">
                                <i class="fa fa-google-plus-official"></i>
                                <div class="td-social-but-text hidden-sm hidden-xs">Poster sur Google plus</div>
                            </a>
                        </li>
                        <li>
                            <a class="td-social-sharing-buttons visible-xs td-social-whatsapp" href="whatsapp://send?text={{$discussion->title}}{{URL::to('/').'/'.Request::path()}}">
                                <i class="fa fa-whatsapp"></i>
                            </a>
                        </li>
                    </ul>





                </div>
                @foreach($posts as $post)
                <?php
                $body = $discussion->post;
                $discussion_body = '';
                $discussion_id = 0;
                if (count($body)) {
                    $discussion_body = $body[0]["body"];
                    $discussion_id = $body[0]["id"];
                }
                ?>
                @if($post->id==$discussion_id)


                <div class="alert alert-default bg-info ">
                    <!-- Alert Messages -->                        
                    <div class="tab-pane fade in active hupsize-1 "  id="alert-1">
                        <p class="text-muted text-xs">Détails sur le problème</p>
                        <div >

                            {{$discussion_body}}

                        </div>               
                    </div>
                    <!-- End Alert Messages -->                        

                    <!-- Links in Alerts -->
                </div>
                @if($discussion->postsCount[0]->total>0)
                <div class="tab-v2margin-bottom-40">
                    <ul class="navnav-tabs list-unstyled ">
                        <li class="active"><a class="text-muted bold" href="#alert-1" data-toggle="tab" aria-expanded="true">Réponses ({{$discussion->postsCount[0]->total}})</a></li>

                    </ul>    
                </div>
                @else
                <div class="clear-o text-center">
                    <h1 class="huge-3 text-muted-0 text-muted"><i class="fa fa-pencil-square-o"></i></h1>
                    <p>Aucune réponse pour le moment</p>
                </div>
                @endif
                @else

                <div class="clearfix">
                    <div class="col-sm-10" data-id="{{ $post->id }}" data-markdown="{{ $post->markdown }}">
                        <div class="row comment-cadre">
                            <div class="col-xs-3 col-sm-1 pad0">
                                <img src="{{asset('uploads/users/img.jpg')}}" class="comment-img img-circle" />
                            </div>
                            <div class="col-xs-9 text-justify  col-sm-11">
                                <h5 class="m0"><a class="no-links" href="{{url(config('forum.routes.home').'/profil/'.$post->user()->first()->id)}}">{{$post->user()->first()->name}}</a></h5>
                                <p class="text-muted text-sm">{{\Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans()}}</p>

                                <p class="text-md" style="">
                                    {{$post->body}}
                                </p>

                            </div>

                        </div>

                    </div>
                    <div class="col-sm-2 comment-cadre-actions">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h3 class="m0 pad15">22</h3>
                            </div>
                            <div class="col-xs-6 cover-like">
                                <a class="btn btn-block no-link" href="#"><i class="fa fa-arrow-up "></i></a>
                            </div>
                            <div class="col-xs-6 cover-dislike">
                                <a class="btn btn-block no-link" href="#"><i class="fa fa-arrow-down "></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 ">
                                <a class="btn btn-block text-muted" title="Partager" href="#"><i class="fa fa-share-alt"></i> </a>
                            </div>
                            <div class="col-xs-6 ">
                                <a class="btn btn-block text-danger"  title="Signaler" href="#"><i class="fa  fa-twitch"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                <div class="col-md-10  text-right">
                    <div id="pagination m0">{{ $posts->links() }}</div>
                </div>
                @if(Auth::guest())
                <div class="col-sm-12  pad0">
                    <div class="panel  alert alert-success shadow1 bgf9">
                        <h4 class=" text-success ">Voulez vous internenir dans cette discussion ?</h4>
                        <p class="text-">Si vous avez un compte, <a class="text-danger" href="{{route('login')}}">connectez vous !</a></p>
                        <p class="text-">Nouveau, <a class="" href="{{route('register')}}">créer un compte maintenant !</a></p>
                    </div>
                </div>
                @else
                <div class="col-sm-12 pad0">
                    <h4 class=" text-muted ">Répondre au sujet</h4>
                </div>
                <form action="{{url(Request::path() )}}" method="POST">

                    {{ csrf_field() }}
                    <div class="col-sm-10 bordere ">

                        <div class="row comment-cadre  mbottom0 bordere shadow1 rond0  no-sbg">

                            <div class="col-xs-3 col-sm-1 pad0">
                                <img src="{{asset('uploads/users/img.jpg')}}" class="comment-img img-circle" />
                            </div>
                            <div class="col-xs-9 text-justify  col-sm-10">
                                <h5 class="m0">{{Auth::user()->name}}</h5>
                                <p class="text-muted text-sm">Il y a 3 jours</p>
                            </div>
                            <div class="col-sm-12 pad0 mtop5">
                                @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                @endif
                                <input type="hidden" name="discussion_id" value="{{$discussion->id}}" />
                                <textarea rows="3" name="body" class="form-control no-bordere bgfb no-s no-shad m5_0" placeholder="Laisser ici votre réponse" cols="8" >{{old('body')}}</textarea>
                            </div>
                            <div class="col-sm-12  pad0 bgf text-right" >
                                <div class="mtop20">

                                    <input type="submit" value="Soumettre"  class="btn btn-primary rond3 no-border "/>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-2 pad0  text-right" >
                        <div class="pad0 ">

                            <ul class="list-inline text-xs">
                                <li>
                                    <a class="text-muted" href="#"> Comment poster un bon commentaire ?</a>
                                </li>
                            </ul>
                        </div>  
                    </div>

                </form>
                @endif

            </div>
            <div class="col-md-3">
                <div class="  pad15_0">
                    <div class="panel panel-default hidden no-border">
                        <div class=" panel-headings pad15 bgf9 ">
                            Partagez : 
                        </div>
                        <div class="panel-body text-center">
                            <a class="mt-facebook mt-share-inline-bar-sm" target="_blanck"
                               href="https://www.facebook.com/sharer/sharer.php?u={{URL::to('/').'/'.Request::path()}}">
                                <img src="http://mojotech-static.s3.amazonaws.com/facebook@2x.png">
                            </a>
                            <a class="mt-twitter mt-share-inline-bar-sm" target="_blanck"
                               href="http://twitter.com/intent/tweet?text=&amp;url={{URL::to('/').'/'.Request::path()}}">
                                <img src="http://mojotech-static.s3.amazonaws.com/twitter@2x.png">
                            </a>
                            <!--                            <a class="mt-linkedin mt-share-inline-bar-sm" target="_blanck"
                                                           href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{URL::to('/').'/'.Request::path()}}&amp;summary=">
                                                            <img src="http://mojotech-static.s3.amazonaws.com/linkedin@2x.png">
                                                        </a>-->
                            <a class="mt-google mt-share-inline-bar-sm" target="_blanck"
                               href="https://plus.google.com/share?url={{URL::to('/').'/'.Request::path()}}">
                                <img src="http://mojotech-static.s3.amazonaws.com/google@2x.png">
                            </a>
                        </div>
                    </div>             
                </div>  
            </div>
        </div>

    </div>
</div>


@stop