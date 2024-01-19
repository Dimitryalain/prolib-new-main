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
    <h1>LISTE DES AUDITS</h1>
    <table>
        <thead>
            <tr>
                <th>Date Heure</th>
                <th>Utilisateur</th>
                <th>Opérations efféctuées </th>
                <th>Anciennes données</th>
                <th>Nouvelles données</th>
            </tr>
        </thead>
        <tbody>
            @foreach($audits as $audit)
                <tr>
                    <td>{{ $audit->created_at }}</td>
                    <td>{{ $audit->user_id }}</td>
                    <td>{{ $audit->action }}</td>
                    <td>{{ $audit->old_data }}</td>
                    <td>{{ $audit->new_data }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
