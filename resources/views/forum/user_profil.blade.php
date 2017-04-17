@extends('layouts.app')

@section('content')
@section('css')

@endsection
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <img src="{{asset('uploads/users/img.jpg')}}" alt="John" class="img-profil">
                <div class="container-m">
                    <h3>{{$user->name}}</h3>
                    <p class="title">CEO & Founder, Example</p>
                    <p>Harvard University</p>
                    <a href="#"><i class="fa fa-dribbble"></i></a> 
                    <a href="#"><i class="fa fa-twitter"></i></a> 
                    <a href="#"><i class="fa fa-linkedin"></i></a> 
                    <a href="#"><i class="fa fa-facebook"></i></a> 
                    <p><button>Contact</button></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tab-v2 margin-bottom-40">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#alert-1" data-toggle="tab" aria-expanded="true">Sujets</a></li>
                    <li ><a href="#alert-2" data-toggle="tab" aria-expanded="false">Discussions</a></li>
                    <li><a href="#alert-3" data-toggle="tab">Notes</a></li>
                </ul>                
                <div class="tab-content">
                    <!-- Alert Messages -->                        
                    <div class="tab-pane fade in active" id="alert-1">
                        <div >
                            <div id="posts">
                                <ul class="discussions list-unstyled">
                                    {!! \App\Helpers\HtmlRender::HtmlConvertePost($discussions)!!}
                                </ul>
                            </div>

                        </div>               
                    </div>
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
