@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel-heading bold no-border bgf9">Réinitialiser votre mot de passe</div>
            <div class="alert alert-default text-muted no-border">
                Veuillez entrez votre courrier électronique, un mail vous sera envoyé afin de vous permettre de réinitialiser votre mot de passe.<br>
                <b>Vous sera appelé à vous connecter à votre compte.</b>
            </div>
            <div class="panel panel-default bgfb">

                <div class="panel-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-8 col-md-offset-2 text-left">
                                <label for="email" class=" control-label">Votre e-Mail</label><br><br>
                            </div>
                            <div class="col-md-8 col-md-offset-2">
                                <input id="email" type="email" class="form-control" placeholder="votrenom@domaine.com" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-2 ">
                                <button type="submit" class="btn btn- btn-primary">
                                    Envoyer le lien  <i class="fa fa-send-o"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 text-center">
                <ul class="list-unstyled">
                    <li><a class="btn btn-links text-muted"  href="{{ route('login') }}">Connexion</a></li>
                    <li><a class="btn btn-links text-muted"  href="{{ route('register') }}">Créer un compte</a></li>
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection
