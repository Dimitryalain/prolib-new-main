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
    <h1>LISTE DES EMPLOYÉS</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Genre</th>
                <th>Role</th>
                <th>Téléphone</th>
                <th>E-mail</th>
                <th>Etat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->nom }}</td>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->sexe }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            {{ $role->nom }}
                            @if (!$loop->last) <!-- Si ce n'est pas le dernier rôle, ajoutez une virgule -->
                                ,
                            @endif
                        @endforeach
                    </td>
                    <td>{{ $user->telephone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->action == '0')
                            Activer
                        @elseif ($user->action == '1')
                            Désactiver
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
