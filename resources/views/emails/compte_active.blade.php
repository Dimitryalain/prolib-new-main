<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre compte Profession Libérale a été activé</title>
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
            color: #2ecc71;
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
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Félicitations ! Votre compte Profession Libérale a été activé</h1>
        <p>Bonjour {{ $professionnel->nom }} {{ $professionnel->prenom }},</p>
        <p>Nous sommes ravis de vous informer que votre compte Profession Libérale a été activé avec succès.</p>
        <p>Vous pouvez désormais accéder à votre compte et profiter de nos services spécialisés.</p>
        <p>Nous sommes impatients de travailler avec vous et de contribuer à votre succès professionnel.</p>
        <p>Merci et bienvenue !</p>

        <!-- Bouton stylisé pour la redirection vers la page de connexion -->
        <a href="{{ route('login-professionnel') }}">Se connecter</a>
    </div>
</body>
</html>
