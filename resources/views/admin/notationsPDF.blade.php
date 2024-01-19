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
    <h1>LISTE DES NOTATIONS</h1>
    <table>
        <thead>
            <tr>
                <th>Nom & Prénom du Professionnel</th>
                <th>Moyenne des Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rdvs as $rdv)
                <tr>
                    <td class="text-center">{{$rdv->profession->nom}} {{$rdv->profession->prenom}}</td>
                    <td class="text-center">{{ number_format($rdv->profession->rdv_avg_note, 1, '.', '') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
