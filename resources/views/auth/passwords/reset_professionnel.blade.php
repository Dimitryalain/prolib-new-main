@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="background-color: #00B98E; color: white;">{{ __("Réinitialisation de mot de passe") }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.sendResetLinkEmailProfessionnel') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse e-mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="margin-bottom: 10px;"> <!-- Ajout de la marge inférieure -->
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div><br>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="background-color: #0c2646; border-color: #0c2646;">
                                        {{ __('Réinitialiser le mot de passe') }}
                                    </button>
                                </div>
                            </div>
                        </form>
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
            width: 350px;
        }
    </style>
@endsection
