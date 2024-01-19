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
    <h1>LISTE DES PROFESSIONNELS</h1>
    <table>
        <thead>
            <tr>
                <th class="text-center">Nom & Prénom</th>
                <th class="text-center">Adresse</th>
                <th class="text-center">E-mail</th>
                <th class="text-center">Profession</th>
                <th class="text-center">Téléphone</th>
                <th class="text-center">Etat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($Professions as $Profession)
                <tr>
                    <td class="text-center">{{ $Profession->nom }} {{ $Profession->prenom }}</td>
                    <td class="text-center">{{ $Profession->adresse }}</td>
                    <td class="text-center">{{ $Profession->adresse_email }}</td>
                    <td class="text-center">{{ $Profession->profession }}</td>
                    <td class="text-center">{{ $Profession->telephone }}</td>
                    <td>
                        @if ($Profession->action == '0')
                            Désactiver
                        @elseif ($Profession->action == '1')
                            Activer
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
