@extends('layouts.app')

@section('content')
@section('css')

@endsection
<div class="container">
    <div class="row">
        <div class="col-md-2  ">
            <style>

            </style>
            <p class="text-muted pad0_5 m0">Menu </p>
            <ul class="list-unstyled" id="menu-profil">
                <li ><a href="{{route('showProfil')}}"><i class="fa fa-home"></i> Accueil</a></li>
                <li ><a href="{{route('showProfilAccount')}}"><i class="fa fa-user-o"></i> Compte</a></li>
                <li ><a href="{{route('showProfilSujet')}}"><i class="fa fa-question-circle-o"></i> Sujets</a></li>
                <li ><a href="{{route('showProfilDiscussions')}}"><i class="fa fa-comments-o"></i> Discussions</a></li>
                <li><a href="{{route('showProfilContacts')}}"><i class="fa fa-address-card-o"></i> Contacts</a></li>
                </ul>
            </div>
            <div class="col-md-10">
            <?php
      $colorbg = \App\Helpers\DataHelper::stringToColorCode($user->email);
      $colortext = \App\Helpers\DataHelper::TextColor($colorbg);
      ?>
                                         <div class="card" style="border-top: 0px solid #{{$colorbg}} !important;color:#{{$colortext}} !important" id="profil-cover">
                  <div class="row">
                      <div class="col-sm-3 text-center">
                          <img src="{{asset('uploads/users/img.jpg')}}" alt="John" class="img-profil">
                      </div>
                      <div class="container-m">
                          <div class="rond0  m0 user_title">{{$user->name}}</div>
                          <ul class="list-unstyled">
                              <li class="title">CEO & Founder, Example</li>
                              <li class="title">Harvard University</li>
                          </ul>

                          <ul class="list-inline circle-list  ">
                              <li> <a data-toggle="tooltip" data-placement="top" title="Contacter par Facebook" href="#"><i class="fa fa-facebook"></i></a> </li>
                              <li><a data-toggle="tooltip" data-placement="top" title="Contacter par Twitter" href="#"><i class="fa fa-twitter"></i></a> </li>
                              <li><a data-toggle="tooltip" data-placement="top" title="Contacter par LinkedIn" href="#"><i class="fa fa-linkedin"></i></a></li>
                              <li><a data-toggle="tooltip" data-placement="top" title="Envoyer un message" href="#"><i class="fa fa-envelope-open-o"></i></a></li>
                          </ul>
                      </div>
                  </div>
              </div>            
              <div class="col-md-7 pad0 mtop10">   
                  <div>
                      <div id="alert-1">
                          <div >
                              <div id="posts" class="bgf pad15">
                                  <ul class="discussions   list-unstyled">
                                      {!! \App\Helpers\HtmlRender::HtmlConvertePost($discussions)!!}
                                  </ul>
                              </div>

                          </div>               
                      </div>
                  </div>
              </div>            
          </div>

          <div class="col-md-12  col-md-offset-">
              dzklzdlk
          </div>
          <div class="col-md-6">
              <div class="tab-v2 hidden  margin-bottom-40">
                  <ul class="nav nav-tabs ">
                      <li class="active"><a href="#alert-1" data-toggle="tab" aria-expanded="true">Sujets</a></li>
                      <li ><a href="#alert-2" data-toggle="tab" aria-expanded="false">Discussions</a></li>
                      <li><a href="#alert-3" data-toggle="tab">Notes</a></li>
                  </ul> 
              </div>
              <div>
                  <div class="tab-content mtop5">
                      <!-- Alert Messages -->                        

                      <!-- End Alert Messages -->                        

                      <!-- Dismissable Alerts -->                        
                      <div class="tab-pane fade " id="alert-2">
                          <div class="margin-bottom-15"></div>
                          <div class="alert alert-warning fade in alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Warning!</strong> Best check yo self, you're not looking too good.
                          </div>
                          <div class="alert alert-danger fade in alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Oh snap!</strong> Change a few things up and try submitting again.
                          </div>                
                          <div class="alert alert-success fade in alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Well done!</strong> Change a few things up and try submitting again.
                          </div>                
                          <div class="alert alert-info fade in alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Heads up!</strong> Change a few things up and try submitting again.
                          </div>                
                      </div>
                      <!-- End Dismissable Alerts -->                        

                      <!-- Links in Alerts -->
                      <div class="tab-pane fade in" id="alert-3">
                          <div class="margin-bottom-15"></div>
                          <div class="alert alert-warning fade in alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Warning!</strong> Best check yo self, <a class="alert-link" href="#">you're not looking too good.</a>
                          </div>
                          <div class="alert alert-danger fade in">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Oh snap!</strong> Change a few things up and <a class="alert-link" href="#">try submitting again.</a>
                          </div>                
                          <div class="alert alert-success fade in">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Well done!</strong> <a class="alert-link" href="#">Change a few things up</a> and try submitting again.
                          </div>                
                          <div class="alert alert-info fade in">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <strong>Heads up!</strong> Change a <a class="alert-link" href="#">few things</a> up and try submitting again.
                          </div>                
                      </div>
                      <!-- Links in Alerts -->
                  </div>
              </div>

          </div>
      </div>
                </div>
                @endsection
