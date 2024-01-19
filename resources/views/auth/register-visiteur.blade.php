@extends('layouts.app')

@section('content')

    <div class="card" style="margin:auto;">
       <center> <div class="card-header">{{ __('Inscription Profession Libérale') }}</div> </center>

        <div class="card-body">
            <center>
            <form method="POST" action="{{ route('visiteur.register.submit') }}">
                @csrf

                <div class="form-group row">
                    
                    <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                    <div class="col-md-6">
                        <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>

                        @error('nom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="prenom" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>

                    <div class="col-md-6">
                        <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>

                        @error('prenom')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="date_nais" class="col-md-4 col-form-label text-md-right">{{ __('Date de naissance') }}</label>

                    <div class="col-md-6">
                        <input id="date_nais" type="date" class="form-control @error('date_nais') is-invalid @enderror" name="date_nais" value="{{ old('date_nais') }}" required autocomplete="date_nais">

                        @error('date_nais')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="telephone" class="col-md-4 col-form-label text-md-right">{{ __('Téléphone') }}</label>

                    <div class="col-md-6">
                        <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone">

                        @error('telephone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Addresse email') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Mot de passe') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmé mot de passe') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" style="background-color: #0c2646;">
                            {{ __('Valider') }}
                        </button>
                    </div>
                </div>
            </form>
           </center>
        </div>
    </div>
</div>
</div>
</div>

<style>
    .card {
        margin-top: 90px; /* espacement avec la navbar */
        width: 450px;
    }

    body {
  background-color: #EAF7F0;
    }

    .card-header{
        background-color: #00B98E;
        color: white;
    }

    input{
        width: 300px;   
    }
    
    
</style>
@endsection
@section('scripts')

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{route('welcome') }}";
            }
        });
    </script>
@endif


@endsection

                           
