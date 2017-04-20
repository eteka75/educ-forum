@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                <div class="circle-user-login"><i class="fa fa-user-o"></i></div>
                <div class="panelpanel-default">
                    <div class="panel-body">
                <p class="text-center bold text-muted">Connectez-vous à votre compte</p>
                        <div class="pad10">
                            {{ csrf_field() }}
                            @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            @endif
                            <div class="form-group ">
                                <div class="col-md-12 ">

                                    <label for="email" class=" control-label">E-mail</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group ">

                                        <span class="input-group-addon rond0 bgf9"><i class="fa fa-user"></i></span>
                                        <input id="email" type="email"  placeholder="votrenom@domaine.com" class="form-control " name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
    <!--                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>-->
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="col-sm-12">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon rond0 bgf9"><i class="fa fa-lock"></i></span>

                                        <input id="password" type="password" placeholder="Mot de passe" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
    <!--                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>-->
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Connexion
                                    <i class="fa fa-sign-in"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">

                    <div class="col-md-12 text-center col-md-offset-0">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12 text-muted text-center col-md-offset-0">
                        <hr>
                        <b>Mot de passe oublié ?</b><br>
                        <p class="text-sm">Pas de panique, <a  href="{{ route('password.request') }}">cliquez ici</a> pour réinitialiser
                            <br>Si vous n'avez pas encore de compte, <a  href="{{ route('register') }}">créer le maintenant</a> </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
