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
            @include('includes.menu_categorie');
        </div>
        <div class="col-md-6">


            @if(!Auth::guest())
            <div class="list-card  well bgfb">

                <h4>Quel est votre difficulté ?</h4>
                <div class=" ">
                   

                    {!! Form::open(['url' => '/sujets/new', 'class' => 'pad0 m0', 'files' => true]) !!}

                    @include ('forum.sujets.form')

                    {!! Form::close() !!}
                </div>
            </div>
            @endif
            
        </div>
        <div class="col-md-3">
            
        </div>
    </div>
</div>
@endsection
