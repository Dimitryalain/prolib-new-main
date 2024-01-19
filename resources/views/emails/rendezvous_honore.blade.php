<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous honoré</title>
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
            color: #27ae60;
            margin-bottom: 20px;
        }
        p {
            line-height: 1.6;
            margin-bottom: 15px;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #2980b9;
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
    <div class="container">
        <h1>Rendez-vous honoré</h1>
        <p>Votre rendez-vous avec {{ $professionnel }} le {{ $heureRendezVous }} a été honoré.</p>
        <p>Merci de prendre un moment pour donner votre avis sur ce rendez-vous en <a href="{{ route('donner.note', $rendezvousId) }}">cliquant ici</a>.</p>
        <div class="thank-you">
            <p>Merci pour votre confiance !</p>
        </div>
    </div>
</body>
</html>
