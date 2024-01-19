<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annulation de rendez-vous</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
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
            background-color: #e74c3c;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Profession libérale</h1>
        <p>Bonjour,</p>
        <p>Nous sommes désolés de vous informer que votre rendez-vous a été annulé.</p>
        <p>Détails du rendez-vous annulé :</p>
        <ul>
            <li><strong>Nom du notaire :</strong> {{ $professionnel }}</li>
            <li><strong>Nom du client :</strong> {{ $visiteur }}</li>
            <li><strong>Date et heure du rendez-vous :</strong> {{ $heureRendezVous }}</li>
        </ul>
        <p>Vous pouvez nous contacter pour plus d'informations.</p>
        <div class="thank-you">
            <p>Merci de votre compréhension.</p>
        </div>
    </div>
</body>
</html>
