@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card shadow-lg mx-auto" style="max-width: 500px;">
        <div class="card-header bg-primary text-white text-center">
            <h2>Formulaire de Note et Commentaire</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('enregistrer.note', $rendezvous->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="note">Donnez une note au rendez-vous (entre 1 et 5)</label>
                    <input type="number" name="note" class="form-control" min="1" max="5" required>
                </div>
                <div class="form-group">
                    <label for="commentaire">Commentaire</label>
                    <textarea name="commentaire" class="form-control" rows="4" required></textarea>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    body {
        background-color: #f8f9fa; /* Couleur de fond */
    }

    .card {
        margin-top: 50px; /* Espacement par rapport au haut */
        width: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre légère */
    }

    .card-header {
        background-color: #0c2646; /* Couleur d'arrière-plan de l'en-tête */
        color: white; /* Couleur du texte de l'en-tête */
    }

    input, textarea {
        width: 100%;
        margin-top: 8px;
    }
</style>
@endsection
