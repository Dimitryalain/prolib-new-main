@extends('layouts.app')

@section('content')
    <div class="container">
        @if(count($professions) > 0)
            @foreach($professions as $profession)
                <div class="bloc col-16">
                    <div class="profil">
                        <div class="photo">
                            <img src="{{ $profession->photo }}">
                        </div>
                        <p class="presentation">{{ $profession->description }}</p>
                        <div class="details">
                            <p class="nom_prenom">{{ $profession->nom }} {{ $profession->prenom }}</p>
                            <p>Téléphone: {{ $profession->telephone }}</p>
                            <p>Profession: {{ $profession->profession }}</p>
                            <p>Cabinet: {{ $profession->entreprise_cabinet }}</p>
                
                            <p>E-mail: {{ $profession->adresse_email }}</p>
                            <p>Site web: {{ $profession->site_web }}</p>
                            <p>Education / Formation: {{ $profession->education_formation }}</p>
                            <p>Domaine d'expertise: {{ $profession->domaine_expertise }}</p>
                            
                        </div>
                    </div>
                    <hr>
                    <div class="jour">
                        <div class="jours-semaine" data-date="{{ now()->format('Y-m-d') }}" style="flex-direction: row;">
                            @php
                            $date = now();
                            $joursAffiches = 7;
                            @endphp

                            @for ($i = 0; $i < $joursAffiches; $i++)
                                <div class="jour-date">
                                    <span>{{ $date->translatedFormat('l') }}</span>
                                    <span>{{ $date->translatedFormat('d M') }}</span>

                                    <div class="heures-container">
                                    @foreach($profession->emplois as $emploi)
                                        @php
                                            $emploiDate = $emploi->date_jour;
                                            $jourDate = $date->format('Y-m-d');
                                        @endphp

                                        @if ($emploiDate === $jourDate)
                                            <div class="bloc-blanc{{ $emploi->indisponible ? ' indisponible' : ' disponible' }}">
                                                <a href="{{ route('booking', ['notaireId' => $profession->id, 'date' => $jourDate, 'heureDebut' => substr($emploi->heure_debut, 0, 5)]) }}">
                                                    <span class="heure-debut">{{ substr($emploi->heure_debut, 0, 5) }}</span>
                                                    <span class="heure-fin">{{ substr($emploi->heure_fin, 0, 5) }}</span>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach

                                    </div>
                                </div>

                                @php
                                $date->addDay();
                                @endphp
                            @endfor
                        </div>
                    </div>
                    <div class="notes-etoiles">
                        @if (!empty($profession->moyenne_notes))
                            @php
                            $moyenneGenerale = $profession->moyenne_notes;
                            @endphp

                            <div class="notes-container">
                                <p>Moyenne par RDV</p>
                                <h4>{{ round($moyenneGenerale, 1) }} / 5</h4>
                                <div class="etoiles">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= round($moyenneGenerale))
                                            <span class="etoile pleine">&#9733;</span>
                                        @else
                                            <span class="etoile vide">&#9734;</span>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        @else
                            <div class="notes-container">
                                <p>Aucune note disponible.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <p>Aucun résultat trouvé.</p>
        @endif
@endsection


<style>

    .legende-couleur {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        margin-right: 5px;
    }

    .legende-disponible {
        background-color: white;
        border: 1px solid #ccc;
    }

    .legende-indisponible {
        background-color: #ddd;
        border: 1px solid #ccc;
    }


.bloc-blanc.indisponible {
    background-color: #ddd !important;
    color: black !important; /* Modification de la couleur à noir */
    border: 1px solid #ccc !important;
    pointer-events: none !important;
}

.bloc-blanc.indisponible a {
    font-style: italic !important;
    color: black !important; /* Ajout de la couleur noire au texte du lien */
}


    .notes-etoiles {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 20px;
    }

    .notes-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }

    .etoiles {
        display: flex;
        align-items: center;
        font-size: 24px;
        color: gold;
    }

    .etoile {
        margin-right: 5px;
    }

    .container {
        margin-top: 20px;
    }

    .bloc {
        background-color: #EAF7F0;
        border: 2px solid white;
        border-radius: 10px;
        min-height: 200px;
        margin-bottom: 20px;
        overflow: auto;
        display: flex;
        justify-content: space-between;
        margin-right: 20px;
    }

    .profil {
        padding: 20px;
    }

    .jour {
        padding: 30px;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 30px;
    }

    .bottom-button {
        margin-top: auto;
    }

    .photo {
        display: inline-block;
        vertical-align: middle;
        margin-right: 20px;
    }

    .profil img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .presentation {
        display: inline-block;
        vertical-align: middle;
    }

    .details {
        display: inline-block;
        vertical-align: middle;
    }

    .jour-date {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-right: 15px;
    }

    .jour-date span {
        margin-bottom: 2px;
    }

    .heures-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.bloc-blanc {
    background-color: white;
    border: 1px solid #ccc;
    padding: 5px;
    margin-top: 5px;
    border-radius: 8px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center; /* Ajoutez cette ligne pour centrer horizontalement */
}

.bloc-blanc a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    display: block;
    height: 50px;
    width: 50px;
}

.bloc-blanc .heure-debut,
.bloc-blanc .heure-fin {
    font-weight: bold;
    color: green;
}

body {
    background-color: #EAF7F0;
}

p {
    font-family: "Helvetica Neue", Arial, sans-serif;
    color: #0c2646;
    line-height: 1.6;
    text-align: justify;
    font-size: 16px;
    font-weight: bolder;
}

.nom_prenom {
    font-family: "Helvetica Neue", Arial, sans-serif;
    color: red;
    line-height: 1.6;
    text-align: justify;
    font-size: 16px;
    font-weight: bolder;
}

.jours-semaine {
    font-family: "Helvetica Neue", Arial, sans-serif;
    color: #0c2646;
    line-height: 1.6;
    text-align: justify;
    font-size: 16px;

    display: flex;
        overflow: hidden;
}
</style>

<script>
    $(document).ready(function () {
        moment.locale('fr'); // Définir la locale en français
        var joursSemaine = $('.jours-semaine');
        var arrowLeft = $('#arrow-left');
        var arrowRight = $('#arrow-right');

        // Fonction pour afficher les jours suivants
        function afficherJoursSuivants() {
            var lastDate = joursSemaine.find('.jour-date:last').data('date');
            var nextDate = moment(lastDate).add(1, 'days').format('Y-MM-DD');

            // Vérifier si la date existe déjà
            if (!joursSemaine.find('.jour-date[data-date="' + nextDate + '"]').length) {
                joursSemaine.append('<div class="jour-date" data-date="' + nextDate + '">' +
                    '<span>' + moment(nextDate).format('ddd') + '</span>' +
                    '<span>' + moment(nextDate).format('DD MMMM') + '</span>' +
                    '</div>');

                // Vérifier les créneaux horaires pour le notaire en cours
                var professionId = {{ $professions->isNotEmpty() ? $professions->first()->id : 0 }}; // Utilisez le premier ID s'il existe
                if (professionId) {
                    $.ajax({
                        type: 'GET',
                        url: '/creneaux-horaires',
                        data: { professionId: professionId, date: nextDate },
                        success: function (response) {
                            var heuresContainer = $('<div class="heures-container"></div>');
                            if (response.length > 0) {
                                response.forEach(function (creneau) {
                                    var blocBlanc = $('<div class="bloc-blanc"></div>');
                                    var lien = $('<a></a>').attr('href', '/booking/' + professionId);
                                    lien.text(creneau.heure_debut.substr(0, 5) + ' - ' + creneau.heure_fin.substr(0, 5));
                                    blocBlanc.append(lien);
                                    heuresContainer.append(blocBlanc);
                                });
                            }

                            // Vérifier si la journée existe toujours avant d'ajouter les créneaux horaires
                            var lastDay = joursSemaine.find('.jour-date:last');
                            if (lastDay.length) {
                                lastDay.append(heuresContainer);
                            }
                        }
                    });
                }
            }
        }

        // Gérer le clic sur la flèche gauche
        arrowLeft.on('click', function () {
            joursSemaine.find('.jour-date:last').remove();
        });

        // Gérer le clic sur la flèche droite
        arrowRight.on('click', function () {
            afficherJoursSuivants();
        });
    });
</script>






