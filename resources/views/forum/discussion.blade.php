@extends('layouts.app')
@section('content')
<style>

</style>

<div class="body">
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <h3>
                    <i class="fa fa-question-circle"></i> {{$discussion->title}}
                    <span class="chatter_head_details pull-right"> {{ Config::get('chatter.titles.category') }}<a class="chatter_cat" href="/{{ Config::get('forum.routes.home') }}/{{ Config::get('forum.routes.category') }}/{{ $discussion->category->slug }}" style="background-color:{{ $discussion->category->color }}">{{ $discussion->category->name }}</a></span>
                </h3>
                <div class="tab-v2 margin-bottom-40">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#alert-1" data-toggle="tab" aria-expanded="true">Discussions</a></li>
                        <!--<li ><a href="#alert-2" data-toggle="tab" aria-expanded="false">Discussions</a></li>-->
                        <!--<li><a href="#alert-3" data-toggle="tab">Notes</a></li>-->
                    </ul>                
                    <div class="alert alert-warning no-border">
                        <!-- Alert Messages -->                        
                        <div class="tab-pane fade in active hupsize-1 "  id="alert-1">
                            <div >
                                <?php
                                $body = $discussion->post;
                                $discussion_body = '';
                                if (count($body)) {
                                    $discussion_body = $body[0]["body"];
                                };
                                ?>
                                {{$discussion_body}}

                            </div>               
                        </div>
                        <!-- End Alert Messages -->                        

                        <!-- Links in Alerts -->
                    </div>
                    @for($i=0;$i<10;$i++)
                    <div class="col-sm-10">
                        <div class="row comment-cadre">
                            <div class="col-xs-3 col-sm-1 pad0">
                                <img src="{{asset('uploads/users/img.jpg')}}" class="comment-img img-circles" />
                            </div>
                            <div class="col-xs-9 text-justify  col-sm-10">
                                <h5 class="m0">ETEKA Wilfried</h5>
                                <p class="text-muted">Il y a 3 jours</p>
                            </div>
                            <div class="col-sm-12 pad0">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

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
                        <ul class="list-unstyled">
                            <li>
                                <a class="btn btn-block text-muted" href="#"><i class="fa fa-share-alt"></i> Partager</a>
                            </li>
                            <li>
                                <a class="btn btn-block text-danger" href="#"><i class="fa  fa-twitch"></i> Signaler</a>
                            </li>
                        </ul>
                    </div>
                    @endfor
                    <div class="col-sm-12 pad0">
                        <h4 class="m0 pad15_0">Répondre au sujet</h4>
                    </div>
                    <div class="col-sm-10">
                        <div class="row comment-cadre  bgfb">
                            <div class="col-xs-3 col-sm-1 pad0">
                                <img src="{{asset('uploads/users/img.jpg')}}" class="comment-img img-circles" />
                            </div>
                            <div class="col-xs-9 text-justify  col-sm-10">
                                <h5 class="m0">ETEKA Wilfried</h5>
                                <p class="text-muted">Il y a 3 jours</p>
                            </div>
                            <div class="col-sm-12 pad0">
                                <textarea class="form-control no-border no-bg no-shad m5_0" placeholder="Laisser ici votre réponse" cols="8" ></textarea>
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
                        <ul class="list-unstyled">
                            <li>
                                <a class="btn btn-block text-muted" href="#"><i class="fa fa-share-alt"></i> Partager</a>
                            </li>
                            <li>
                                <a class="btn btn-block text-danger" href="#"><i class="fa  fa-twitch"></i> Signaler</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-12">
                        <hr>
                        <div class="row">
                            <?php
                            $posts = $discussion->posts()->paginate(10);
//                            dd($posts);
                            ?>
                            @if(count($posts)>0)
                            <ul>

                                @foreach($posts as $post)

                                <li data-id="{{ $post->id }}" class="panel panel-body" data-markdown="{{ $post->markdown }}">
                                    <span class="chatter_posts">
                                        @if(!Auth::guest() && (Auth::user()->id == $post->user->id))
                                        <div id="delete_warning_{{ $post->id }}" class="chatter_warning_delete hidden">
                                            <i class="chatter-warning"></i>Are you sure you want to delete this response?
                                            <button class="btn btn-sm btn-danger pull-right delete_response">Yes Delete It</button>
                                            <button class="btn btn-sm btn-default pull-right">No Thanks</button>
                                        </div>
                                        <div class="chatter_post_actions hidden">
                                            <p class="chatter_delete_btn">
                                                <i class="chatter-delete"></i> Delete
                                            </p>
                                            <p class="chatter_edit_btn">
                                                <i class="chatter-edit"></i> Edit
                                            </p>
                                        </div>
                                        @endif




                                        <div class="chatter_clear">
                                            <?= $post->body; ?>
                                        </div>
                                    </span>
                                </li>
                                @endforeach


                            </ul>
                            @endif
                        </div>

                        <div id="pagination">{{ $posts->links() }}</div>
                        @if(!Auth::guest())
                        <div class="panel ">
                            <div class="panel-body  ">
                                <div id="new_response" class="row">

                                    <div class="avatar col-xs-3 col-sm-2 col-md-1 ">
                                        @if(Config::get('chatter.user.avatar_image_database_field'))

                                        <?php $db_field = Config::get('chatter.user.avatar_image_database_field'); ?>

                                        <!-- If the user db field contains http:// or https:// we don't need to use the relative path to the image assets -->
                                        @if( (substr(Auth::user()->{$db_field}, 0, 7) == 'http://') || (substr(Auth::user()->{$db_field}, 0, 8) == 'https://') )
                                        <img src="{{ Auth::user()->{$db_field}  }}">
                                        @else
                                        <img src="{{ Config::get('chatter.user.relative_url_to_image_assets') . Auth::user()->{$db_field}  }}">
                                        @endif

                                        @else
                                        <span class="avatar_circle" style="background-color:#<?= \App\Helpers\DataHelper::stringToColorCode(Auth::user()->email) ?>">
                                            {{ strtoupper(substr(Auth::user()->email, 0, 1)) }}
                                        </span>
                                        @endif
                                    </div>

                                    <div id="new_discussion" class="col-xs-8 col-sm-9">


                                        <div class="chatter_loader dark" id="new_discussion_loader">
                                            <div></div>
                                        </div>

                                        <form id="chatter_form_editor" action="/{{ Config::get('chatter.routes.home') }}/posts" method="POST">

                                            <!-- BODY -->
                                            <div id="editor">
                                                @if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
                                                <label id="tinymce_placeholder">Add the content for your Discussion here</label>
                                                <textarea id="body" class="richText form-control" class="form-control"  name="body" placeholder="">{{ old('body') }}</textarea>
                                                @elseif($chatter_editor == 'simplemde')
                                                <textarea id="simplemde" name="body" class="form-control" placeholder="">{{ old('body') }}</textarea>
                                                @endif
                                            </div>

                                            <input type="hidden" name="_token" id="csrf_token_field" value="{{ csrf_token() }}">
                                            <input type="hidden" name="chatter_discussion_id" value="{{ $discussion->id }}">
                                        </form>

                                        <!-- #new_discussion -->
                                        <div id="discussion_response_email">
                                            <button id="submit_response" class="btn btn-success pull-right"><i class="chatter-new"></i> Submit Response</button>
                                            @if(Config::get('chatter.email.enabled'))
                                            <div id="notify_email">
                                                <img src="/vendor/devdojo/chatter/assets/images/email.gif" class="chatter_email_loader">
                                                <!-- Rounded toggle switch -->
                                                <span>Notify me when someone replies</span>
                                                <label class="switch">
                                                    <input type="checkbox" id="email_notification" name="email_notification" @if(!Auth::guest() && $discussion->users->contains(Auth::user()->id)){{ 'checked' }}@endif>
                                                           <span class="on">Yes</span>
                                                    <span class="off">No</span>
                                                    <div class="slider round"></div>
                                                </label>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @else

                        <div id="login_or_register ">
                            <p>Please <a href="/{{ Config::get('forum.routes.home') }}/login">login</a> or <a href="/{{ Config::get('forum.routes.home') }}/register">register</a> to leave a response.</p>
                        </div>

                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                @if(!Auth::user())
                <div class="">
                    <!--<img src="{{asset('uploads/users/img.jpg')}}" alt="John" class="img-profil">-->
                    <div class="container-m">
                        <h3></h3>
                        <p class="title">CEO & Founder, Example</p>
                        <p>Harvard University</p>
                        <a href="#"><i class="fa fa-dribbble"></i></a> 
                        <p><button>Contact</button></p>
                    </div>
                </div>
                @else
                <div class="cards">

                    <h3>Connectez vous</h3>
                    <form action="{{route('login')}}" method="post">
                        <div class="form-group row ">
                            <div class="col-md-12 ">

                                <label for="email" class=" control-label">E-mail</label>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group ">

                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input id="email" type="email"  placeholder="votrenom@domaine.com" class="form-control " name="email" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
    <!--                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>-->
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <div class="col-sm-12">
                                <label for="password" class="control-label">Password</label>
                            </div>
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                    <input id="password" type="password" placeholder="Mot de passe" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
    <!--                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>-->
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-center form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Connexion
                                <i class="fa fa-sign-in"></i>
                            </button>
                        </div>

                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>


    <input type="hidden" id="chatter_tinymce_toolbar" value="{{ Config::get('chatter.tinymce.toolbar') }}">
    <input type="hidden" id="chatter_tinymce_plugins" value="{{ Config::get('chatter.tinymce.plugins') }}">
    <input type="hidden" id="current_path" value="{{ Request::path() }}">

    @stop

    @section(Config::get('chatter.yields.footer'))

    @if( $chatter_editor == 'tinymce' || empty($chatter_editor) )
    <script>var chatter_editor = 'tinymce';</script>
    @elseif($chatter_editor == 'simplemde')
    <script>var chatter_editor = 'simplemde';</script>
    @endif
    <script src="/vendor/devdojo/chatter/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="/vendor/devdojo/chatter/assets/js/tinymce.js"></script>
    <script>
        /*var my_tinymce = tinyMCE;
         $('document').ready(function(){
         
         $('#tinymce_placeholder').click(function(){
         my_tinymce.activeEditor.focus();
         });
         
         });*/
    </script>

    <script src="/vendor/devdojo/chatter/assets/js/simplemde.min.js"></script>
    <script src="/vendor/devdojo/chatter/assets/js/chatter_simplemde.js"></script>


    <script>
        /*$('document').ready(function(){
         
         var simplemdeEditors = [];
         
         $('.chatter_edit_btn').click(function(){
         parent = $(this).parents('li');
         parent.addClass('editing');
         id = parent.data('id');
         markdown = parent.data('markdown');
         container = parent.find('.chatter_middle');
         
         if(markdown){
         body = container.find('.chatter_body_md');
         } else {
         body = container.find('.chatter_body');
         markdown = 0;
         }
         
         details = container.find('.chatter_middle_details');
         
         // dynamically create a new text area
         container.prepend('<textarea id="post-edit-' + id + '"></textarea>');
         // Client side XSS fix
         $("#post-edit-"+id).text(body.html());
         container.append('<div class="chatter_update_actions"><button class="btn btn-success pull-right update_chatter_edit"  data-id="' + id + '" data-markdown="' + markdown + '"><i class="chatter-check"></i> Update Response</button><button href="/" class="btn btn-default pull-right cancel_chatter_edit" data-id="' + id + '"  data-markdown="' + markdown + '">Cancel</button></div>');
         
         // create new editor from text area
         if(markdown){
         simplemdeEditors['post-edit-' + id] = newSimpleMde(document.getElementById('post-edit-' + id));
         } else {
         initializeNewEditor('post-edit-' + id);
         }
         
         });
         
         $('.discussions li').on('click', '.cancel_chatter_edit', function(e){
         post_id = $(e.target).data('id');
         markdown = $(e.target).data('markdown');
         parent_li = $(e.target).parents('li');
         parent_actions = $(e.target).parent('.chatter_update_actions');
         if(!markdown){
         tinymce.remove('#post-edit-' + post_id);
         } else {
         $(e.target).parents('li').find('.editor-toolbar').remove();
         $(e.target).parents('li').find('.editor-preview-side').remove();
         $(e.target).parents('li').find('.CodeMirror').remove();
         }
         
         $('#post-edit-' + post_id).remove();
         parent_actions.remove();
         
         parent_li.removeClass('editing');
         });
         
         $('.discussions li').on('click', '.update_chatter_edit', function(e){
         post_id = $(e.target).data('id');
         markdown = $(e.target).data('markdown');
         
         if(markdown){
         update_body = simplemdeEditors['post-edit-' + post_id].value();
         } else {
         update_body = tinyMCE.get('post-edit-' + post_id).getContent();
         }
         
         $.form('/{{ Config::get('chatter.routes.home') }}/posts/' + post_id, { _token: '{{ csrf_token() }}', _method: 'PATCH', 'body' : update_body }, 'POST').submit();
         });
         
         $('#submit_response').click(function(){
         $('#chatter_form_editor').submit();
         });
         
         // ******************************
         // DELETE FUNCTIONALITY
         // ******************************
         
         $('.chatter_delete_btn').click(function(){
         parent = $(this).parents('li');
         parent.addClass('delete_warning');
         id = parent.data('id');
         $('#delete_warning_' + id).show();
         });
         
         $('.chatter_warning_delete .btn-default').click(function(){
         $(this).parent('.chatter_warning_delete').hide();
         $(this).parents('li').removeClass('delete_warning');
         });
         
         $('.delete_response').click(function(){
         post_id = $(this).parents('li').data('id');
         $.form('/{{ Config::get('chatter.routes.home') }}/posts/' + post_id, { _token: '{{ csrf_token() }}', _method: 'DELETE'}, 'POST').submit();
         });
         
         });*/


    </script>
    <script src="/vendor/devdojo/chatter/assets/js/chatter.js"></script>

    @stop