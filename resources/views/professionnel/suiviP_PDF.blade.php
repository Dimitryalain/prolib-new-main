<!DOCTYPE html>
<html>
<head>
    <title>Rapport PDF</title>
    <style>
        body {
            text-align: center; /* Centrer tout le contenu */
            font-family: Arial, sans-serif;
        }
        h1 {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            font-size: 10px; /* Réduire la taille de la police */
        }
    </style>
</head>
<body>
    <h1>LISTE DES RDV AVEC LEUR STATUT</h1>
    <table>
        <thead>
            <tr>
                <th>Date de réservation</th>
                <th>Date et heure du RDV</th>
                <th>Objet RDV</th>
                <th>Téléphone client</th>
                <th>Nom du client</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rdvs as $rdv)
                <tr>
                    <td class="text-center">{{$rdv->date_reservation}}</td>
                    <td class="text-center">{{$rdv->date_heure_rdv}}</td>
                    <td class="text-center">{{$rdv->objet}}</td>
                    <td class="text-center">{{$rdv->visiteur->telephone}}</td>
                    <td class="text-center">{{$rdv->visiteur->nom}}</td>    
                <td class="text-center">
                        @if ($rdv->statut =='0')
                        En attente 
                        @elseif ($rdv->statut =='1')
                        Annulé
                        @elseif ($rdv->statut =='2')
                        Rejeté
                        @elseif ($rdv->statut =='3')
                        Accepté
                        @elseif ($rdv->statut =='4')
                        Honoré    
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
