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
    <h1>LISTE DES DEMANDES DE RDV</h1>
    <table>
        <thead>
            <tr>
                <th class="text-center">Date Reservation</th>
                <th class="text-center">Date et Heure RDV</th>
                <th class="text-center">Objet</th>
                <th class="text-center">Cabinet</th>
                <th class="text-center">Professionnel</th>
                <th class="text-center">Client</th>
                <th class="text-center">Téléphone client</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rdvs as $rdv)
                <tr>
                   <td class="text-center">{{$rdv->date_reservation}}</td>
                   <td class="text-center">{{$rdv->date_heure_rdv}}</td>
                   <td class="text-center">{{$rdv->objet}}</td>
                   <td class="text-center">{{$rdv->profession->entreprise_cabinet}}</td>
                   <td class="text-center">{{$rdv->profession->nom}} {{$rdv->profession->prenom}}</td>
                   <td class="text-center">{{$rdv->visiteur->nom}}</td>
                   <td class="text-center">{{$rdv->visiteur->telephone}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
