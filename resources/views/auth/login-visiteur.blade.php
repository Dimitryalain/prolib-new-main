@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <div class="card">
                    <center><div class="card-header">{{ __("J'ai déjà un compte Profession libérale") }}</div></center>

                    <div class="card-body">
                        <center>
                            <form method="POST" action="{{ route('visiteur.login.submit') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse e-mail') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary" style="background-color: #0c2646;">
                                            {{ __('Connexion') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <a href="{{ route('register-visiteur') }}">Créer un compte</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            margin-top: 150px; /* espacement avec la navbar */
            margin-left: 170px; /* décalage vers la droite */
            width: 450px;
        }

        body {
            background-color: #EAF7F0;
        }

        .card-header {
            background-color: #00B98E;
            color: white;
        }

        input {
            width: 300px;
        }
    </style>
@endsection
