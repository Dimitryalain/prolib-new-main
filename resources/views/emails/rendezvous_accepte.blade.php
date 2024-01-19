<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre rendez-vous a été accepté</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            background-color: #f8f8f8;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #3498db;
            margin-bottom: 20px;
        }
        p {
            line-height: 1.6;
            margin-bottom: 15px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
        }
        .thank-you {
            background-color: #2ecc71;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div>
        <h1>Votre rendez-vous a été accepté</h1>
        <p>Bonjour,</p>
        <p>Nous avons le plaisir de vous informer que votre rendez-vous a été accepté.</p>
        <p>Détails du rendez-vous :</p>
        <ul>
            <li><strong>Nom du professionnel :</strong> {{ $professionnel->nom }} {{ $professionnel->prenom }}</li>
            <li><strong>Date et heure du rendez-vous :</strong> {{ $heureRendezVous }}</li>
        </ul>
        <p>Vous pouvez consulter les détails en vous connectant à votre compte.</p>
        <div class="thank-you">
            <p>Merci de votre confiance !</p>
        </div>
    </div>
</body>
</html>
