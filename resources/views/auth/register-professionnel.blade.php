@extends('layouts.app')

@section('content')
<div class="card" style="margin:auto;">
    <center>
        <div class="card-header">{{ __("Formulaire d' inscription Profession libérale") }}</div>
    </center>

    <div class="card-body">
        <div style="color:red;">
        <center>Tous les champs sont obligatoires</center>
        </div>
        <center>
            <form method="POST" action="{{ route('professionnel.register.submit') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="nom">{{ __('Nom') }}</label>
                        <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                            value="{{ old('nom') }}" required autocomplete="nom" autofocus>
                        @error('nom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="prenom">{{ __('Prénom') }}</label>
                        <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror"
                            name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom" autofocus>
                        @error('prenom')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="adresse">{{ __('Ville / Commune') }}</label>
                        <input id="adresse" type="text" class="form-control @error('adresse') is-invalid @enderror"
                            name="adresse" value="{{ old('adresse') }}" required autocomplete="adresse" autofocus>
                        @error('adresse')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="telephone">{{ __('Telephone') }}</label>
                        <input id="telephone" type="tel" class="form-control @error('telephone') is-invalid @enderror"
                            name="telephone" value="{{ old('telephone') }}" required autocomplete="telephone" autofocus>
                        @error('telephone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="entreprise_cabinet">{{ __('Entreprise / Cabinet') }}</label>
                        <input id="entreprise_cabinet" type="text"
                            class="form-control @error('entreprise_cabinet') is-invalid @enderror" name="entreprise_cabinet"
                            value="{{ old('entreprise_cabinet') }}" required autocomplete="entreprise_cabinet" autofocus>
                        @error('entreprise_cabinet')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="site_web">{{ __('Site web') }}</label>
                        <input id="site_web" type="text" class="form-control @error('site_web') is-invalid @enderror"
                            name="site_web" value="{{ old('site_web') }}" autocomplete="site_web" autofocus>
                        @error('site_web')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="domaine_expertise">{{ __('Domaine d\'expertise') }}</label>
                        <input id="domaine_expertise" type="text"
                            class="form-control @error('domaine_expertise') is-invalid @enderror" name="domaine_expertise"
                            value="{{ old('domaine_expertise') }}" required autocomplete="domaine_expertise" autofocus>
                        @error('domaine_expertise')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="date_debut_exercice">{{ __('Date de début d\'exercice') }}</label>
                        <input id="date_debut_exercice" type="date"
                            class="form-control @error('date_debut_exercice') is-invalid @enderror" name="date_debut_exercice"
                            value="{{ old('date_debut_exercice') }}" required autocomplete="date_debut_exercice" autofocus>
                        @error('date_debut_exercice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
        
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="password">{{ __('Mot de passe') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    </div>

                    <div class="col-md-6">
                       <label for="password-confirm">{{ __('Confirmer mot passe ') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="password_confirmation">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="education_formation">{{ __('Éducation / Formation') }}</label>
                        <input id="education_formation" type="text"
                            class="form-control @error('education_formation') is-invalid @enderror" name="education_formation"
                            value="{{ old('education_formation') }}" required autocomplete="education_formation" autofocus>
                        @error('education_formation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="adresse_email">{{ __('Adresse email') }}</label>
                        <input id="adresse_email" type="email"
                            class="form-control @error('adresse_email') is-invalid @enderror" name="adresse_email"
                            value="{{ old('adresse_email') }}" required autocomplete="adresse_email" autofocus>
                        @error('adresse_email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>    
                        <div class="col-md-6">
                            <label for="profession">{{ __('Profession') }}</label>
                            <select id="profession" class="form-control @error('profession') is-invalid @enderror"
                                name="profession" required value="{{ old('profession') }}" required autocomplete="profession" autofocus>
                                <option value="">------------</option>
                                <option value="Avocat">Avocat</option>
                                <option value="Architecte">Architecte</option>
                                <option value="Expert Comptable">Expert Comptable</option>
                                <option value="Géomètre">Géomètre</option>
                                <option value="Coach">Coach</option>
                                <option value="Ingenieur Conseil">Ingenieur conseil</option>
                                <option value="Notaire">Notaire</option>
                                <option value="Dentiste">Dentiste</option>
                                <option value="Huissier">Huissier</option>
                                <option value="Orthophoniste">Orthophoniste</option>
                            </select>
                            @error('profession')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    
                        <div class="col-md-6">
                        <label for="description">{{ __('Présentez-vous ici') }}</label>
                        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> 
                    </div>
                </div> 
                     <br>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">{{ __('Valider le formulaire') }}</button>
                        </div>
                    </div>
                    <br>
             </form>
          </center>
    </div>
</div>
</div>
</div>

<style>
    .card {
        margin-top: 100px; /* espacement avec la navbar */
        width: 900px;
    }

    body {
        background-color: #EAF7F0;
    }

    .card-header {
        background-color: #00B98E;
        color: white;
    }

    input, select {
        width: 100%;
    }
</style>
@endsection

@section('scripts')
   
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
                    Swal.fire({
                        icon: 'info',
                        title: 'INFORMATION !!!',
                        text: "Notre équipe étudie les informations que vous avez transmises. Nous vous notifierons dans les 72 heures pour l'activation de votre compte.",
                        confirmButtonText: 'OK'
                    }).then((innerResult) => {
                        if (innerResult.isConfirmed) {
                            // Rediriger l'utilisateur vers la route "maison"
                            window.location.href = "{{ route('welcome') }}";
                        }
                    });
                }
            });
        </script>
    @endif

@endsection


