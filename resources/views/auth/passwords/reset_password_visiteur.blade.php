@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
    <!-- Ajout des styles Bootstrap pour améliorer l'apparence -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Style personnalisé pour centrer le formulaire */
        .center-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <!-- Div pour centrer le formulaire -->
    <div class="center-form">
        <div class="container">
            <h2 class="text-center mb-4">Réinitialisation de mot de passe</h2>

            <!-- Affichage des erreurs -->
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Formulaire de réinitialisation de mot de passe -->
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <!-- Champ caché pour le token -->
                <input type="hidden" name="token" value="{{ $token }}">

                <!-- Champ pour l'email -->
                <div class="form-group">
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                </div>

                <!-- Champ pour le nouveau mot de passe -->
                <div class="form-group">
                    <label for="password">Nouveau mot de passe :</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <!-- Champ pour la confirmation du nouveau mot de passe -->
                <div class="form-group">
                    <label for="password_confirmation">Confirmer le nouveau mot de passe :</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                </div>

                <!-- Bouton de soumission -->
                <button type="submit" class="btn btn-primary">Réinitialiser le mot de passe</button>
            </form>
        </div>
    </div>
</body>
</html>

@endsection
