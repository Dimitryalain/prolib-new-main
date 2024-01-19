@extends('layouts.app')

@section('content')

<center>
<div class="container">

    <div class="bloc">
        <h4>Votre rendez-vous n'est pas encore confirmé.</h4>
        
        <form action="{{ route('saveRdv') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="date_reservation">Date de réservation :</label>
                <input type="date" id="date_reservation" name="date_reservation" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
            
            <div class="form-group">
                <label for="date_heure_rdv">Date et heure du rendez-vous :</label>
                <input type="datetime-local" id="date_heure_rdv" name="date_heure_rdv" class="form-control" value="{{ $date_heure_rdv }}">
            </div>
            

            <div class="form-group">
                <label for="profession_id">Nom du professionnel :</label>
                <select id="profession_id" name="profession_id" class="form-control" required>
                    <option value="">Sélectionnez un professionnel</option>
                    <option value="{{ $profession->id }}">{{ $profession->nom }} {{ $profession->prenom }}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="visiteur_id">Entrer votre nom :</label>
                <select id="visiteur_id" name="visiteur_id" class="form-control" required>
                    <option value="">Sélectionnez votre nom dans cette liste</option>
                    @foreach($visiteurs as $visiteur)
                        <option value="{{ $visiteur->id }}">{{ $visiteur->nom }} {{ $visiteur->prenom }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label for="objet">Choisir le motif du Rendez-Vous :</label>
                <select id="objet" name="objet" class="form-control" required>
                    <option value="">Sélectionnez un motif</option>
                    
                    <!-- Motifs pour les notaires -->
                    <optgroup label="Notaire">
                        <option value="succession">Succession</option>
                        <option value="contrat_mariage">Contrat de mariage</option>
                        <option value="achat_immobilier">Achat immobilier</option>
                    </optgroup>

                    <!-- Motifs pour les avocats -->
                    <optgroup label="Avocat">
                        <option value="plaidoyer">Plaidoyer</option>
                        <option value="conseils_juridiques">Conseils juridiques</option>
                        <option value="litiges">Litiges</option>
                    </optgroup>

                    <!-- Motifs pour les architectes -->
                    <optgroup label="Architecte">
                        <option value="conception_projet">Conception de projet</option>
                        <option value="permis_construction">Permis de construction</option>
                        <option value="renovation">Rénovation</option>
                    </optgroup>

                    <!-- Motifs pour les coachs -->
                    <optgroup label="Coach">
                        <option value="coaching_personnel">Coaching personnel</option>
                        <option value="coaching_professionnel">Coaching professionnel</option>
                        <option value="coaching_sportif">Coaching sportif</option>
                    </optgroup>

                    <!-- Motifs pour les ingénieurs conseil -->
                    <optgroup label="Ingénieur Conseil">
                        <option value="conseil_technique">Conseil technique</option>
                        <option value="etudes_faisabilite">Études de faisabilité</option>
                        <option value="gestion_projet">Gestion de projet</option>
                    </optgroup>

                    <!-- Motifs pour les experts-comptables -->
                    <optgroup label="Expert-Comptable">
                        <option value="comptabilite_entreprise">Comptabilité d'entreprise</option>
                        <option value="declaration_impots">Déclarations d'impôts</option>
                        <option value="audit_financier">Audit financier</option>
                    </optgroup>

                    <!-- Motifs pour les géomètres -->
                    <optgroup label="Géomètre">
                        <option value="arpentage_terrain">Arpentage de terrain</option>
                        <option value="cartographie">Cartographie</option>
                        <option value="bornage">Bornage</option>
                    </optgroup>

                    <!-- Motifs pour les dentises -->
                    <optgroup label="Dentiste">
                        <option value="examenRoutine">Examen de routine et nettoyage</option>
                        <option value="traitementCaries">Traitement de caries</option>
                        <option value="consultationProblemes">Consultation pour problèmes bucco-dentaires spécifiques</option>
                    </optgroup>


                    <!-- Motifs pour les Huissiers -->
                    <optgroup label="Huissier">
                        <option value="signification_acte">Signification d'acte</option>
                        <option value="recouvrement_creances">Recouvrement de créances</option>
                        <option value="constatation">Constatation d'infraction</option>
                    </optgroup>


                    <!-- Motifs pour les Orthophonistes -->
                    <optgroup label="Orthophoniste">
                        <option value="bilan_langage">Bilan de langage</option>
                        <option value="trouble_prononciation">Trouble de prononciation</option>
                        <option value="retard_langage">Retard de langage</option>
                    </optgroup>


                    <!-- Option "Autres" -->
                    <option value="Autres">Autres</option>
                </select>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Confirmer le rendez-vous</button>
            </div>
        </form>
    </div>
 
</div>
</center>

<style>

.bloc {
        background-color: #EAF7F0;
        border: 2px solid white;
        border-radius: 10px;
        padding: 40px;
        max-width: 400px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        margin-top: 70px; /* Ajoutez une marge supérieure de 20px */
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

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: '{{ session('success') }}',
            showCancelButton: true,
            confirmButtonText: 'Oui',
            confirmButtonText: 'Oui',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'question',
                    title: 'Connexion',
                    text: 'Voulez-vous  connecter à votre espace client ?',
                    showCancelButton: true,
                    confirmButtonText: 'Oui',
                    cancelButtonText: 'Non',
                }).then((loginResult) => {
                    if (loginResult.isConfirmed) {
                        // Rediriger vers la page de connexion
                        window.location.href = "{{route('login-visiteur')}}";
                    } else {
                        // Rediriger vers la page d'accueil
                        window.location.href = "{{route('welcome')}}";
                    }
                });
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Cacher tous les groupes de motifs au début
        $(".motifs-group").hide();

        // Gérer le changement de profession
        $("#profession_id").change(function () {
            // Cacher tous les groupes de motifs
            $(".motifs-group").hide();

            // Afficher le groupe de motifs correspondant à la nouvelle profession sélectionnée
            $("#motifs_" + $(this).val()).show();
        });
    });
</script>
@endif



@endsection
