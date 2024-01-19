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
    <h1>LISTE DES AVIS</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>E-mail</th>
                <th>Sujet</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach($avis as $avi)
                <tr>
                    <td>{{ $avi->nom }}</td>
                    <td>{{ $avi->email }}</td>
                    <td>{{ $avi->sujet }}</td>
                    <td>{{ $avi->message }}</td>                  
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
