<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre rendez-vous a été rejeté</title>
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
            color: #e74c3c;
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
        .contact-us {
            background-color: red;
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
        <h1>Votre rendez-vous a été rejeté</h1>
        <p>Bonjour,</p>
        <p>Nous sommes désolés de vous informer que votre rendez-vous a été rejeté.</p>
        <p>Détails du rendez-vous rejeté :</p>
        <ul>
            <li><strong>Nom du professionnel :</strong> {{ $professionnel}}</li>
            <li><strong>Date et heure du rendez-vous :</strong> {{ $heureRendezVous }}</li>
        </ul>
        <p>Vous pouvez nous contacter pour plus d'informations.</p>
        <div class="contact-us">
            <p>Merci de votre compréhension.</p>
        </div>
    </div>
</body>
</html>
