@extends('layouts.app')

@section('content')

<div class="container">

    <center><h4>Prenez votre rendez-vous en ligne</h4></center><br><br>
    <center>
    <div class="bloc">
        <center>
            <div class="photo">
                <img src="{{ asset($profession->photo) }}" class="profil" alt="Photo du notaire">
            </div>

            <p class="notaire">{{ $profession->nom }} {{ $profession->prenom }}</p>
            <p>Votre réservation est pour le {{ date('d/m/Y', strtotime($date)) }} à {{ $heureDebut }}</p>

            <div class="titre">
                <h5>Avez-vous un compte Prolib ?</h5>
            </div>

            <p>Si vous prenez rendez-vous pour quelqu'un d'autre, cette question le concerne</p>
            <div class="actions">
                <a href="#" class="btn" id="nonBtn">Non</a>
                <a href="{{ route('detail', ['notaireId' => $profession->id, 'date' => $date, 'heureDebut' => $heureDebut]) }}" class="btn">Oui</a>
            </div>
        </center>
    </div>
</center>
</div>

<style>

.bloc {
    background-color: #EAF7F0;
    border: 2px solid white;
    border-radius: 10px;
    padding: 20px;
    max-width: 400px;
    text-align: center;
}

.titre {
    margin-bottom: 10px;
}

.photo img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
}

.notaire {
    font-size: 18px;
    font-weight: bold;
}

.actions {
    margin-top: 20px;
}

.actions .btn {
    display: inline-block;
    margin: 0 5px;
    padding: 10px 20px;
    background-color: #0c2646;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.actions .btn:hover {
    background-color: #083051;
}

h4{
    font-weight: bolder;
    color: #0c2646
}
</style>

@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('nonBtn').addEventListener('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Pour prendre rendez-vous avec {{ $profession->nom }} {{ $profession->prenom }}',
            text: 'Vous devez créer un compte Profession libérale.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Créer ',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                // Rediriger vers la page de création de compte
                window.location.href = "{{ route('register-visiteur') }}";

            }
        });
    });
    </script>
    
@endsection
