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
    <h1>LISTE DES CLIENTS</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>E-mail</th>
                <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visiteurs as $visiteur)
                <tr>
                    <td>{{ $visiteur->nom }}</td>
                    <td>{{ $visiteur->prenom }}</td>
                    <td>{{ $visiteur->telephone }}</td>
                    <td>{{ $visiteur->email }}</td>
                    <td>
                        @if ($visiteur->action == '0')
                            Activer
                        @elseif ($visiteur->action == '1')
                            Désactiver
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
